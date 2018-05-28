<?php

use yii\db\Migration;

/**
 * Class m180405_090059_create_tbl_studio
 */
class m180405_090059_create_tbl_studio extends Migration
{

    public function safeUp()
    {
        $this->createTable('tbl_studio', [
            'id' => $this->primaryKey(),
            'u_id' => $this->integer(7)->notNull(),
            'url' => $this->string(30)->notNull(),
            'studioName' => $this->string(100)->notNull(),
            //'email' => $this->string(100)->notNull(),
            'tel' => $this->string(10),
            'lineID' => $this->string(20),
            /*'placeOfWork' => $this->text(),
            'workType' => $this->string(50),
            'coverImg' => $this->string(100)*/
            'confirmation' => $this->string(30)->defaultValue('none-verified')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m180401_182512_create_tbl_studio cannot be reverted.\n";
        $this->dropTable('tbl_studio');
        //return false;
    }

}
