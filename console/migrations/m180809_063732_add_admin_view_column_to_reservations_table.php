<?php

use yii\db\Migration;

/**
 * Handles adding admin_view to table `reservations`.
 */
class m180809_063732_add_admin_view_column_to_reservations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('reservations', 'admin_view', $this->integer(2)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('reservations', 'admin_view');
    }
}
