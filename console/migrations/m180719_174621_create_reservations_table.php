<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reservations`.
 */
class m180719_174621_create_reservations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reservations', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'studio_id' => $this->integer()->notNull(),
            'create_time' => $this->timestamp(),
            'update_time' => $this->timestamp()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('reservations');
    }
}
