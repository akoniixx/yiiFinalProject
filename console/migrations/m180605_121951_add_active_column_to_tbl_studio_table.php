<?php

use yii\db\Migration;

/**
 * Handles adding active to table `tbl_studio`.
 */
class m180605_121951_add_active_column_to_tbl_studio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_studio', 'active', $this->timeStamp());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbl_studio', 'active');
    }
}
