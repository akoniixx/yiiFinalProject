<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "userdb".
 *
 * @property int $id
 * @property string $password รหัสผ่าน
 * @property string $firstName ชื่อ
 * @property string $lastName นามสกุล
 * @property string $email อีเมล
 * @property string $tel เบอร์โทรศัพท์
 * @property string $usreType
 * @property string $imgProfile
 */
class Userdb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $password_repeat;
    public $userType;

    public static function tableName()
    {
        return 'userdb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password', 'firstName', 'lastName', 'email'], 'required'],
            [['password', 'firstName', 'lastName', 'email'], 'string', 'max' => 100],
            [['email'], 'unique', 'message' => 'อีเมลนี้สามารถใช้ได้'],
            [['tel'], 'string', 'max' => 30],
            //[['userType'], 'string', 'max' => 5],
            [['imgProfile'], 'string', 'max' => 255],
            [['password_repeat'], 'required'],
            [['password_repeat'], 'compare', 'compareAttribute'=>'password', 'message'=>"รหัสผ่านไม่ถูกต้อง" ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password' => 'รหัสผ่าน',
            'password_repeat' => 'ยืนยันรหัสผ่าน',
            'firstName' => 'ชื่อ',
            'lastName' => 'นามสกุล',
            'email' => 'อีเมล',
            'tel' => 'เบอร์โทรศัพท์',
            //'userType' => 'Usre Type',
            'imgProfile' => 'Img Profile',
        ];
    }
}
