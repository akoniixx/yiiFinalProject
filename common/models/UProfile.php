<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "u_profile".
 *
 * @property int $id
 * @property string $firstName ชื่อ
 * @property string $lastName นามสกุล
 * @property string $tel เบอร์โทร
 * @property string $usreType
 * @property int $u_id
 * @property string $imgProfile
 */
class UProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $array_status = ['A' => 'Admin', 'U' => 'User', 'P' => 'Partner', 'FB' => 'Facebook'];

    public static function tableName()
    {
        return 'uProfile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'u_id'], 'required'],
            [['u_id'], 'integer'],
            [['firstName', 'lastName'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 10],
            //[['usreType'], 'string', 'max' => 5],
            //[['imgProfile'], 'file', 'extensions' => 'png, jpg, jpeg, gif', 'maxFiles' => 5, 'skipOnEmpty' => false],
            // [['imgProfile'], 'string', 'max' => 255],
            [['imgProfile'], 'file', 'extensions'=>'jpg, png', 'skipOnEmpty' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'ชื่อ',
            'lastName' => 'นามสกุล',
            'tel' => 'เบอร์โทร',
            'usreType' => 'Usre Type',
            'u_id' => 'U ID',
            'imgProfile' => 'Img Profile',
        ];
    }

    public function getUser(){
        return $this->hasOne(SignupForm::className(),['id'=>'u_id']);
    }

    /*public function getFullname(){
        return $this->title.$this->name.' '.$this->surname;
    }*/

    /*public function getUsername(){
        return $this->user->username;
    }*/

    public function uploadProfileImage($id)
    {
        $findUser = UProfile::findOne($id);
        // return $findUser->id;
        $dirName = 'profile'.$id;
        $path = Yii::getAlias('@app').'/web/uploads/profile/'.$dirName;
        FileHelper::createDirectory($path);
        $fileName = 'icon-profile';
        // $files=\yii\helpers\FileHelper::findFiles('/path/to');
        // $delete = FileHelper::findFiles($path) ? unlink($path . '/' . $findUser->imgProfile) : null;
        $this->imgProfile->saveAs($path . '/' . $fileName . '.' . $this->imgProfile->extension);
        $fullName = $fileName . '.' . $this->imgProfile->extension;
        return $fullName;
    }

    public function checkStatus($status)
    {
        foreach ($this->array_status as $key => $value) {
            if ($status == $key) {
                return $value;
            }
        }
    }
}
