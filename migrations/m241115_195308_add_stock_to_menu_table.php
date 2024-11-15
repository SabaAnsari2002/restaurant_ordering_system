<?php


use yii\db\Migration;

class m241115_195308_add_stock_to_menu_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%menu}}', 'stock', $this->integer()->defaultValue(0)); // Add stock column
    }

    public function down()
    {
        $this->dropColumn('{{%menu}}', 'stock');
    }
}
