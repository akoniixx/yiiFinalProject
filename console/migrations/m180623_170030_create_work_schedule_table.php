<?php

use yii\db\Migration;

/**
 * Handles the creation of table `work_schedule`.
 */
class m180623_170030_create_work_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('work_schedule', [
            'id' => $this->primaryKey(),
            'graduation_id' => $this->integer()->notNull(),
            's_id' => $this->integer()->notNull(),
            'typeOfWork' => $this->string(3)->notNull(),
            'created_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('work_schedule');
    }
}
