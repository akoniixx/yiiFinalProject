<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "reservations".
 *
 * @property int $id
 * @property int $user_id
 * @property int $studio_id
 * @property string $created_at
 */
class Reservations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $created_at;
    public $updated_at;
    public $name;
    public $work;
    public $work_detail;
    public $reservation_date;
    public $type;
    public $contact;

    const VISITED = 1;
    const NO_VISITED = 0;
    const CONFIRM = 'confirm';
    const PENDING = 'pending';
    const DELETE = 'delete';

    public static function tableName()
    {
        return 'reservations';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'studio_id'], 'required'],
            [['user_id', 'studio_id'], 'integer'],
            [['create_time', 'update_time', 'reservation_date'], 'safe'],
            [['status_view'], 'integer'],
            [['status'], 'string', 'max' => 10]
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
            'studio_id' => 'รหัสสตูดิโอ',
            'create_time' => 'Created At',
            'status' => Yii::t('common', 'Status'),
            'name' => Yii::t('common', 'User Name'),
            'tel' => Yii::t('common', 'Tel'),
            'work_detail' => Yii::t('common', 'Work Detail'),
            'reservation_date' => Yii::t('common', 'Date Of Work'),
            'type' => Yii::t('common', 'Type Of Work'),
            'work' => Yii::t('common', 'Occupation'),
            'contact' => Yii::t('common', 'Contact'),
        ];
    }

    public function arrayStatus()
    {
        return [
            'confirm' => 'จองสำเร็จ',
            'delete' => 'จองล้มเหลว',
            'pending' => 'รอการตวจสอบ',
        ];
    }

    public function getReservationDetail()
    {
        return $this->hasOne(ReservationDetail::className(), ['reservation_id' => 'id']);
    }

    public function getStudioDetail()
    {
        return $this->hasOne(TblStudio::className(), ['id' => 'studio_id']);
    }

}
