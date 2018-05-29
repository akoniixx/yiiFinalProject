<?php

use yii\db\Migration;

/**
 * Handles adding initials to table `occupation`.
 */
class m180529_175433_add_initials_column_to_occupation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('occupation', 'initials', $this->string(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('occupation', 'initials');
    }
}
