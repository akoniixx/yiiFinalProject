<?php

namespace common\models;

use Yii;
//use common\models\TblStudio;
use common\models\UProfile;
use common\models\TblAlbum;
use common\models\TblCategories;
use common\models\VerifyMember;
use common\models\Confirmation;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "tbl_studio".
 *
 * @property int $id ID
 * @property int $userID userID
 * @property string $url url
 * @property string $studioName ชื่อสตูดิโอ
 * @property string $email email
 * @property string $tel เบอร์โทรศัพท์
 * @property string $lineID ไลน์ไอดี
 * @property string $placeOfWork สถานที่รับงาน
 * @property string $workType ประเภทงานที่รับ
 * @property string $coverImg ภาพพื้นหลัง
 */
class TblStudio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $sid;
    public $searchstring;
    public $latitude;
    public $longitude;

    public static function tableName()
    {
        return 'tbl_studio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'url', 'studioName'], 'required'],
            [['url'], 'unique'],
            ['url', 'match', 'pattern' => '/^[0-9A-Za-z-_]{6,25}$/'],
            [['u_id'], 'integer'],
            //[['placeOfWork'], 'string'],
            [['url', 'confirmation'], 'string', 'max' => 30],
            [['studioName'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 10],
            [['lineID'], 'string', 'max' => 20],
            [['searchstring'], 'safe'],
            [['description', 'latitude', 'longitude'], 'string'],
            //[['workType'], 'string', 'max' => 50],
            [['cover_image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 3072000, 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Studio ID',
            'u_id' => 'u_id',
            'url' => 'url',
            'studioName' => 'ชื่อสตูดิโอ',
            //'email' => 'email',
            'tel' => 'เบอร์โทรศัพท์',
            'lineID' => 'ไลน์ไอดี',
            'description' => 'รายละเอียดเพิ่มเติม',
            'placeOfWork' => 'สถานที่รับงาน',
            'workType' => 'ประเภทงานที่รับ',
            'coverImg' => 'ภาพพื้นหลัง',
            'latitude' => 'ละติจูด',
            'longitude' => 'ลองจิจูด',
            //'gimages' => 'uploadImage',
        ];
    }

    public function getIDPartner()
    {
        $id = Yii::$app->user->getId();
        $profileID = UProfile::find()->where(['userType' => 'P', 'u_id' => $id])->one();
        
        if (isset($profileID)) { 
            $sid = TblStudio::find()->where(['u_id' => $id])->one();
            if (!isset($sid)) {
                $sid = $sid->u_id;
            }
        }
        return $sid;
    }

    public function uploadCoverImage($id, $img)
    {
        $findStudio = TblStudio::findOne($id);
        // return $findUser->id;
        $dirName = 'profile'.$id;
        $path = Yii::getAlias('@app').'/web/uploads/profile/'.$dirName;
        FileHelper::createDirectory($path);
        $fileName = 'background-cover';
        // $files=\yii\helpers\FileHelper::findFiles('/path/to');
        // $delete = FileHelper::findFiles($path) ? unlink($path . '/' . $img) : null;
        $this->cover_image->saveAs($path . '/' . $fileName . '.' . $this->cover_image->extension);
        $fullName = $fileName . '.' . $this->cover_image->extension;
        return $fullName;
    }

    public function getUserProfile()
    {
        return $this->hasOne(UProfile::className(), ['id' => 'u_id']);
    }

    public function getAlbums()
    {
        return $this->hasMany(TblAlbum::className(), ['studioID' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(TblCategories::className(), ['s_id' => 'id']);
    }

    public function getVerifiedMember()
    {
        return $this->hasOne(VerifyMember::className(), ['studio_id' => 'id']);
    }

    public function getConfirmStatus()
    {
        return $this->hasOne(Confirmation::className(), ['confirm_id' => 'confirmation']);
    }
}
