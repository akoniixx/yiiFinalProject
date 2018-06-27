<?php

use yii\db\Migration;

/**
 * Handles the creation of table `graduation_details`.
 */
class m180614_182259_create_graduation_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('graduation_details', [
            'id' => $this->primaryKey(),
            'initials' => $this->string(2),
            'detail' => $this->string(50)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('graduation_details');
    }
}
