<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transfer_slip`.
 */
class m180802_125140_create_transfer_slip_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transfer_slip', [
            'id' => $this->primaryKey(),
            'transfer_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'studio_name' => $this->string(100),
            'tel' => $this->string(10),
            'transfer_time' => $this->datetime(),
            'amount' => $this->integer(7)->notNull(),
            'slip_image' => $this->string()->notNull(),
            'bank_from' => $this->string(),
            'bank_to' => $this->string(),
            'bank_id' => $this->string(5),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('transfer_slip');
    }
}
