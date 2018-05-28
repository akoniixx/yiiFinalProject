<?php

namespace common\models;

use Yii;
use \yii\web\UploadedFile;
use common\models\TblStudio;
use common\models\VerifyStatus;

/**
 * This is the model class for table "verify_member".
 *
 * @property int $verify_id
 * @property string $img_idCard
 * @property string $img_profile
 * @property string $fname
 * @property string $lname
 * @property string $tel
 * @property int $studio_id
 * @property string $created_at
 */
class VerifyMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'verify_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fname', 'lname', 'studio_id'], 'required', 'message' => 'กรุณาใส่{attribute}'],
            [['studio_id'], 'integer'],
            [['created_at'], 'safe'],
            [['img_profile','img_idCard'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'message' => 'กรุณาอับโหลด{attribute}'],
            [['img_idCard', 'img_profile'], 'string', 'max' => 255],
            [['fname', 'lname'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 20],
            [['verify_status'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verify_id' => 'Verify ID',
            'img_idCard' => 'ภาพถ่ายบัตรประชาชน',
            'img_profile' => 'ภาพถ่ายขณะถือบัตร',
            'fname' => 'ชื่อจริง',
            'lname' => 'นามสกุล',
            'tel' => 'เบอร์โทรศัพท์มือถือ',
            'studio_id' => 'Studio ID',
            'created_at' => 'วันที่ส่งข้อมูล',
        ];
    }

    public function uploadImages($model, $attr, $id)
    {
        $image = UploadedFile::getInstance($model, $attr);
        $path = Yii::getAlias('@app').'/web/uploads/verify/';

        if ($image !== NULL) {
            if ($attr == 'img_idCard') {
                $fileName = $attr.$id.'.'.$image->extension;
            } else {
                $fileName = $attr.$id.'.'.$image->extension;
            }
            if ($image->saveAs($path.$fileName)) {
                return $fileName;
            }   
            //return $fileName; 
        }
    }

    public function getStudioValidation()
    {
        return $this->hasOne(TblStudio::className(), ['id' => 'studio_id']);
    }

    public function getVerifyStatus()
    {
        return $this->hasOne(VerifyStatus::className(), ['status_id' => 'verify_status']);
    }
}