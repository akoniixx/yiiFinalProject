<?php

use yii\db\Migration;

/**
 * Handles dropping date from table `graduation_schedule`.
 */
class m180614_191038_drop_date_column_from_graduation_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('graduation_schedule', 'date');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('graduation_schedule', 'date', $this->timestamp());
    }
}
