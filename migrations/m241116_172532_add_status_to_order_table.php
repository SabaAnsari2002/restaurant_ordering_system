
<?php

use yii\db\Migration;

class m241116_172532_add_status_to_order_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'status', $this->string(50)->notNull()->defaultValue('Pending'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'status');
    }
}
