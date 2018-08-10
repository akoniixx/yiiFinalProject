<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $userID
 * @property string $firstname
 * @property string $lastname
 * @property string $address
 * @property string $tel
 * @property string $link
 * @property string $imgProfile
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['address'], 'string'],
            [['firstname', 'lastname'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 20],
            [['link'], 'string', 'max' => 300],
            [['imgProfile'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userID' => 'User ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'address' => 'Address',
            'tel' => 'Tel',
            'link' => 'Link',
            'imgProfile' => 'Img Profile',
        ];
    }

}
