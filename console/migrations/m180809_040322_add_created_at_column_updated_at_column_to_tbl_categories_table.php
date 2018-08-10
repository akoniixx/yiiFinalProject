<?php

use yii\db\Migration;

/**
 * Handles adding created_at_column_updated_at to table `tbl_categories`.
 */
class m180809_040322_add_created_at_column_updated_at_column_to_tbl_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_categories', 'created_at', $this->integer());
        $this->addColumn('tbl_categories', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbl_categories', 'created_at');
        $this->dropColumn('tbl_categories', 'updated_at');
    }
}
