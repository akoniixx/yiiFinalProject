<?php

use yii\db\Migration;

/**
 * Handles the creation of table `graduation_schedule`.
 */
class m180614_171054_create_graduation_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('graduation_schedule', [
            'id' => $this->primaryKey(),
            'schedule' => $this->string()->notNull(),
            'details' => $this->string(),
            'date' => $this->timestamp()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('graduation_schedule');
    }
}
