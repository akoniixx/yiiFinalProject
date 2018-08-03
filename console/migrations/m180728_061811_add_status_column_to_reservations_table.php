<?php

use yii\db\Migration;

/**
 * Handles adding status to table `reservations`.
 */
class m180728_061811_add_status_column_to_reservations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('reservations', 'status', $this->string(10)->defaultValue('pending'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('reservations', 'status');
    }
}
