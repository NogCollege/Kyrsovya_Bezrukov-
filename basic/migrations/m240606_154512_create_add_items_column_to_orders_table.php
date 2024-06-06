<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%add_items_column_to_orders}}`.
 */
class m240606_154512_create_add_items_column_to_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('orders', 'items', $this->text()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('orders', 'items');
    }
}
