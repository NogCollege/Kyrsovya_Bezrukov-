<?php

use yii\db\Migration;

/**
 * Class m240606_164949_add_status_to_order
 */
class m240606_164949_add_status_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%orders}}', 'status', $this->string()->notNull()->defaultValue('Pending'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%orders}}', 'status');
    }


    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240606_164949_add_status_to_order cannot be reverted.\n";

        return false;
    }
    */
}
