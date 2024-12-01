<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pizza_order}}`.
 */
class m241201_195926_create_pizza_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pizza_order}}', [
            'id' => $this->primaryKey(),
            'bread_types' => $this->string()->notNull(),
            'sausage_types' => $this->string()->notNull(),
            'toppings' => $this->string()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%pizza_order}}');
    }
}
