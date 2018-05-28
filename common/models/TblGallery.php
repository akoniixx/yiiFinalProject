<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use common\models\TblAlbum;

/**
 * This is the model class for table "tbl_gallery".
 *
 * @property int $gID
 * @property int $aID
 * @property string $gName
 * @property string $gimages
 * @property string $date
 * @property string $status
 */
class TblGallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'tbl_gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aID', 'gName'], 'required'],
            [['aID'], 'integer'],
            [['date'], 'safe'],
            [['gName', 'gimages'], 'string', 'max' => 255],
            [['gimages'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 5, 'skipOnEmpty' => false],
            [['status'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'gID' => 'G ID',
            'aID' => 'A ID',
            'gName' => 'G Name',
            'gimages' => 'Gimages',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }

    public function upload($value)
    {
        if ($this->validate()) {
            $path = Yii::getAlias('@webroot').'/uploads/user/'. $this->$value;
            FileHelper::createDirectory($path);
            //$upload->gimages->saveAs($path .'/'. $upload->gimages->baseName . '.' . $upload->gimages->extension);
            
            foreach ($this->gimages as $file) {

                $file->saveAs($path . $file->baseName . '.' . $file->extension);
            }
            return $path;
        } else {
            return false;
        }
    }

    public function uploadGallery()
    {
        if (!$this->validate()) {
            return null;
        }

        $gallery = new TblGallery();
        //$album->aid
    }

    public function getAlbumn()
    {
        return $this->hasOne(TblAlbum::className(), ['albumID' => 'aID']);
    }
}
