<?php

use yii\db\Migration;

/**
 * Handles adding updated_at to table `reservations`.
 */
class m180724_075008_add_updated_at_column_to_reservations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('reservations', 'updated_at', $this->timestamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('reservations', 'updated_at');
    }
}
