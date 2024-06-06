<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m240604_180708_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'address' => $this->string(255)->notNull(),
            'total' => $this->decimal(10, 2)->notNull(),
            'created_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-orders-user_id}}',
            '{{%orders}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-orders-user_id}}',
            '{{%orders}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-orders-user_id}}',
            '{{%orders}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-orders-user_id}}',
            '{{%orders}}'
        );

        $this->dropTable('{{%orders}}');
    }
}