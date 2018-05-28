<?php

use yii\db\Migration;

/**
 * Class m180525_092842_create_alter_verify_status
 */
class m180525_092842_create_alter_verify_status extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('verify_member', 'verify_status', $this->integer(2)->defaultValue(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /*echo "m180525_092842_create_alter_verify_status cannot be reverted.\n";

        return false;*/
        $this->alterColumn('verify_member', 'verify_status', 'string');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180525_092842_create_alter_verify_status cannot be reverted.\n";

        return false;
    }
    */
}
