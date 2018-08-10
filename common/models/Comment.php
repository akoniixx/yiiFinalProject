<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $studio_id
 * @property int $rating
 * @property string $comment
 * @property int $created_at
 * @property int $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    // public $userType;
    public $studioName;

    public static function tableName()
    {
        return 'comment';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(), 
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'studio_id', 'rating'], 'required'],
            [['user_id', 'studio_id', 'rating', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'studio_id' => 'Studio ID',
            'rating' => 'Rating',
            'comment' => 'แสดงความคิดเห็น',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(UProfile::className(), ['u_id' => 'user_id']);
    }

    public function getStudio()
    {
        return $this->hasOne(TblStudio::className(), ['u_id' => 'user_id']);
    }
}
