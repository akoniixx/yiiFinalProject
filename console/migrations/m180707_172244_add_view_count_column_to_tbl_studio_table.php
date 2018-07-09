<?php

use yii\db\Migration;

/**
 * Handles adding view_count to table `tbl_studio`.
 */
class m180707_172244_add_view_count_column_to_tbl_studio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_studio', 'view_count', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbl_studio', 'view_count');
    }
}
