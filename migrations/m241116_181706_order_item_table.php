
<?php

use yii\db\Migration;

class m241116_181706_order_item_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%order_item}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'menu_id' => $this->integer()->notNull(),
            'quantity' => $this->integer()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
        ]);

        $this->addForeignKey('fk-order_item-order_id', '{{%order_item}}', 'order_id', '{{%order}}', 'id', 'CASCADE');
        $this->addForeignKey('fk-order_item-menu_id', '{{%order_item}}', 'menu_id', '{{%menu}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%order_item}}');
    }
}