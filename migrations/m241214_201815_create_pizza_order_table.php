
<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pizza_order}}`.
 */
class m241214_201815_create_pizza_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pizza_order}}', [
            'id' => $this->primaryKey(),
            'restaurant_id' => $this->integer()->notNull(),
            'bread_types' => $this->string()->notNull(),
            'sausage_types' => $this->string()->notNull(),
            'toppings' => $this->string()->notNull(),
            'bread_price' => $this->decimal(10, 2)->notNull(), // قیمت نان
            'sausage_price' => $this->decimal(10, 2)->notNull(), // قیمت سوسیس
            'toppings_price' => $this->decimal(10, 2)->notNull(), // قیمت افزودنی‌ها
        ]);

        // تعریف کلید خارجی برای ارتباط با جدول رستوران‌ها
        $this->addForeignKey(
            'fk_pizza_order_restaurant',
            '{{%pizza_order}}',
            'restaurant_id',
            '{{%restaurant}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_pizza_order_restaurant', '{{%pizza_order}}');
        $this->dropTable('{{%pizza_order}}');
    }
}
