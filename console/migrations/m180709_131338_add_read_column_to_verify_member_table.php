<?php

use yii\db\Migration;

/**
 * Handles adding read to table `verify_member`.
 */
class m180709_131338_add_read_column_to_verify_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('verify_member', 'read', $this->integer()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('verify_member', 'read');
    }
}
