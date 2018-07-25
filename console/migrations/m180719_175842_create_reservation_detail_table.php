<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reservation_detail`.
 */
class m180719_175842_create_reservation_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reservation_detail', [
            'id' => $this->primaryKey(),
            'reservation_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'tel' => $this->string(10)->notNull(),
            'work' => $this->string(50),
            'work_detail' => $this->string(),
            'reservation_date' => $this->date(),
            'type' => $this->string(10),
            'contact' => $this->string(),
            'status' => $this->string(10),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('reservation_detail');
    }
}
