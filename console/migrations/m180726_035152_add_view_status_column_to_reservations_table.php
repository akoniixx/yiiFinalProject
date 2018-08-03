<?php

use yii\db\Migration;

/**
 * Handles adding view_status to table `reservations`.
 */
class m180726_035152_add_view_status_column_to_reservations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('reservations', 'status_view', $this->integer(2)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('reservations', 'status_view');
    }
}
