<?php

use yii\db\Migration;

/**
 * Class m180413_090042_create_tbl_album
 */
class m180413_090042_create_tbl_album extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tbl_album',[
            'albumID' => $this->primaryKey(),
            'studioID' => $this->integer()->notNull(),
            'albumName' => $this->string(255)->notNull(),
            'type' => $this->string(20),
            'image' => $this->string(255)->notNull(),
            'create_time' => $this->timestamp(),
            'update_time' => $this->timestamp(),
            'status' => $this->string(15)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m180402_085733_create_tbl_albumn cannot be reverted.\n";
        $this->dropTable('tbl_album');
        //return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180413_090042_create_tbl_album cannot be reverted.\n";

        return false;
    }
    */
}
