<?php


use yii\db\Migration;

class m241115_150729_create_menu_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'restaurant_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'category' => $this->string()->notNull(),
            'photo' => $this->string()->null(), // Optional photo path
        ]);

        $this->addForeignKey('fk_menu_restaurant', '{{%menu}}', 'restaurant_id', '{{%restaurant}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_menu_restaurant', '{{%menu}}');
        $this->dropTable('{{%menu}}');
    }
}
