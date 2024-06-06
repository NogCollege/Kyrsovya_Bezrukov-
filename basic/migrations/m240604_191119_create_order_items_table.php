<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_items}}`.
 */
class m240604_191119_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_items', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'product_name' => $this->string()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'quantity' => $this->integer()->notNull(),
        ]);

        // Add foreign key for table `order_items`
        $this->addForeignKey(
            'fk-order_items-order_id',
            'order_items',
            'order_id',
            'orders',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // Add foreign key for table `order_items`
        $this->addForeignKey(
            'fk-order_items-product_id',
            'order_items',
            'product_id',
            'texno',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-order_items-order_id', 'order_items');
        $this->dropForeignKey('fk-order_items-product_id', 'order_items');
        $this->dropTable('order_items');
    }
}
