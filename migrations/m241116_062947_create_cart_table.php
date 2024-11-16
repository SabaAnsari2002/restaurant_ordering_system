<?php

use yii\db\Migration;

class m241116_062947_create_cart_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'restaurant_id' => $this->integer()->notNull(),
            'menu_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->defaultValue(1),
        ]);

        $this->addForeignKey('fk_cart_user', '{{%cart}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_cart_menu', '{{%cart}}', 'menu_id', '{{%menu}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_cart_restaurant', '{{%cart}}', 'restaurant_id', '{{%restaurant}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_cart_user', '{{%cart}}');
        $this->dropForeignKey('fk_cart_menu', '{{%cart}}');
        $this->dropForeignKey('fk_cart_restaurant', '{{%cart}}');
        $this->dropTable('{{%cart}}');
    }
}
