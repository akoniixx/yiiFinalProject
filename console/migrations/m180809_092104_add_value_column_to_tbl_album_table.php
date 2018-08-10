<?php

use yii\db\Migration;

/**
 * Handles adding value to table `tbl_album`.
 */
class m180809_092104_add_value_column_to_tbl_album_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_album', 'value', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbl_album', 'value');
    }
}
