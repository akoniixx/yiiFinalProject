<?php

namespace common\models;

use Yii;
//use common\models\TblStudio;
use common\models\UProfile;
use common\models\TblAlbum;
use common\models\TblCategories;
use common\models\VerifyMember;
use common\models\Confirmation;

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
            [['u_id'], 'integer'],
            //[['placeOfWork'], 'string'],
            [['url', 'confirmation'], 'string', 'max' => 30],
            [['studioName'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 10],
            [['lineID'], 'string', 'max' => 20],
            [['searchstring'], 'safe'],
            //[['workType'], 'string', 'max' => 50],
            //[['gimages'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 5, 'skipOnEmpty' => false],
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
            'placeOfWork' => 'สถานที่รับงาน',
            'workType' => 'ประเภทงานที่รับ',
            'coverImg' => 'ภาพพื้นหลัง',
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
