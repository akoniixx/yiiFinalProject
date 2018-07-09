<?php

use yii\db\Migration;

/**
 * Handles adding description to table `tbl_studio`.
 */
class m180705_172741_add_description_column_to_tbl_studio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_studio', 'description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbl_studio', 'description');
    }
}
