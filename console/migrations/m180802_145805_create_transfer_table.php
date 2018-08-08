<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transfer`.
 */
class m180802_145805_create_transfer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transfer', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->integer(2)->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status_view' => $this->integer(1)->defaultValue(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transfer');
    }
}
