<?php

use yii\db\Migration;

/**
 * Handles adding cover_image to table `tbl_studio`.
 */
class m180611_125311_add_cover_image_column_to_tbl_studio_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tbl_studio', 'cover_image', $this->string()->defaultValue('background-default.png'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tbl_studio', 'cover_image');
    }
}
