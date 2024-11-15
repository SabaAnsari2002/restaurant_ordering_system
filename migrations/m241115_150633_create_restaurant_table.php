<?php


use yii\db\Migration;

class m241115_150633_create_restaurant_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%restaurant}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'contact_number' => $this->string(15)->notNull(),
            'address' => $this->string()->notNull(),
            'categories' => $this->text()->notNull(), // JSON encoded selected categories
        ]);

        $this->addForeignKey('fk_restaurant_user', '{{%restaurant}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_restaurant_user', '{{%restaurant}}');
        $this->dropTable('{{%restaurant}}');
    }
}
