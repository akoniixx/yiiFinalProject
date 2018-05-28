<?php

use yii\db\Migration;

/**
 * Class m180525_090337_create_verify_status
 */
class m180525_090337_create_verify_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('verify_status', [
            'status_id' => $this->primaryKey(),
            'status_name' => $this->string(20)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('verify_status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180525_090337_create_verify_status cannot be reverted.\n";

        return false;
    }
    */
}
