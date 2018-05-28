<?php

use yii\db\Migration;

/**
 * Class m180413_090052_create_tbl_gallery
 */
class m180413_090052_create_tbl_gallery extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_gallery',[
            'gID' => $this->primaryKey(),
            'aID' => $this->integer()->notNull(),
            'gName' => $this->string(255)->notNull(),
            'gimages' => $this->string(255),
            'date' => $this->timestamp(),
            'status' => $this->string(15)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m180402_085749_create_tbl_gallery cannot be reverted.\n";
        $this->dropTable('tbl_gallery');
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_090052_create_tbl_gallery cannot be reverted.\n";

        return false;
    }
    */
}
