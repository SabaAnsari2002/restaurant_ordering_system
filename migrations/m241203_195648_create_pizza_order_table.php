<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%pizza_order}}`.
 */
class m241203_195648_create_pizza_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pizza_order}}', [
            'id' => $this->primaryKey(),
            'restaurant_id' => $this->integer()->notNull(), // کلید خارجی برای ارتباط با جدول رستوران‌ها
            'bread_types' => $this->string()->notNull(),
            'sausage_types' => $this->string()->notNull(),
            'toppings' => $this->string()->notNull(),
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
