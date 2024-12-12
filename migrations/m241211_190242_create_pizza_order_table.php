<?php
use yii\db\Migration;

class m241211_190242_create_pizza_order_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%pizza_order}}', [
            'id' => $this->primaryKey(),
            'restaurant_id' => $this->integer()->notNull(),
            'bread_types' => $this->text()->notNull(), // ذخیره انواع نان به صورت JSON
            'sausage_types' => $this->text()->notNull(), // ذخیره انواع سوسیس به صورت JSON
            'toppings' => $this->text()->notNull(), // ذخیره تاپینگ‌ها به صورت JSON
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // ایجاد کلید خارجی برای restaurant_id
        $this->addForeignKey(
            'fk-pizza_order-restaurant_id',
            '{{%pizza_order}}',
            'restaurant_id',
            '{{%restaurant}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        // حذف کلید خارجی
        $this->dropForeignKey('fk-pizza_order-restaurant_id', '{{%pizza_order}}');

        // حذف جدول
        $this->dropTable('{{%pizza_order}}');
    }
}

