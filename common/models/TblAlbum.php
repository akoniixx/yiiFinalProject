<?php

namespace common\models;

use Yii;
use common\models\TblGallery;

/**
 * This is the model class for table "tbl_album".
 *
 * @property int $albumID
 * @property int $stidoID
 * @property string $albumName
 * @property string $type
 * @property string $image
 * @property string $date
 * @property string $status
 */
class TblAlbum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    //public $cateAlbum;

    public static function tableName()
    {
        return 'tbl_album';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['studioID', 'albumName'], 'required'],
            [['studioID'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['albumName'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 15],
            //[['cateAlbum'], 'required'],
            /*############# old #############*/
            /*[['studioID', 'albumName', 'image'], 'required'],
            [['studioID'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['albumName', 'image'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 15],*/

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'albumID' => 'Album ID',
            'studioID' => 'Studio ID',
            'albumName' => 'ชื่ออัลบั้ม',
            //'cateAlbum' => 'ประเภทอัลบั้ม',
            'type' => 'ประเภทงาน',
            'image' => 'Image',
            //'date' => 'Date',
            'status' => 'Status',
        ];
    }

    public function uploadAlbum()
    {
        if (!$this->validate()) {
            return null;
        }

        $album->studioID = $id;
        $album->albumName = $albumName;
        $album->type = $cateAlubm;
        $album->image = '11.jpg';
        $album->status = 'process';
        return $album->save();
    }

    public function getGalleryList()
    {
        return $this->hasMany(TblGallery::className(), ['aID' => 'albumID']);
    }
}
