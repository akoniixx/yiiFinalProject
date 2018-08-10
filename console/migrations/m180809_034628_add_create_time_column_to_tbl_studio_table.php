<?php

use yii\db\Migration;

/**
 * Handles adding create_time to table `tbl_studio`.
 */
class m180809_034628_add_create_time_column_to_tbl_studio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_studio', 'created_at', $this->integer());
        $this->addColumn('tbl_studio', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbl_studio', 'create_time');
    }
}
