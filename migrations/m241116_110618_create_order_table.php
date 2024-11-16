<?php

use yii\db\Migration;

class m241116_110618_create_order_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'customer_name' => $this->string()->notNull(),
            'phone_number' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey(
            'fk-order-restaurant_id',
            '{{%order}}',
            'restaurant_id',
            '{{%restaurant}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}
