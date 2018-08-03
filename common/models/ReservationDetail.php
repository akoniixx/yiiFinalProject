<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reservation_detail".
 *
 * @property int $id
 * @property int $reservation_id
 * @property string $name
 * @property string $tel
 * @property string $work_detail
 * @property string $reservation_date
 * @property string $status
 */
class ReservationDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const HALF_DAY = 1;
    const ALL_DAY = 2;

    public static function tableName()
    {
        return 'reservation_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reservation_id', 'name', 'tel', 'work'], 'required'],
            [['reservation_id'], 'integer'],
            [['reservation_date'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['work'], 'string', 'max' => 50],
            [['tel', 'status', 'type'], 'string', 'max' => 10],
            [['work_detail', 'contact'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reservation_id' => 'Reservation ID',
            'name' => Yii::t('common', 'User Name'),
            'tel' => Yii::t('common', 'Tel'),
            'work_detail' => Yii::t('common', 'Work Detail'),
            'reservation_date' => Yii::t('common', 'Date Of Work'),
            'status' => 'Status',
            'type' => Yii::t('common', 'Type Of Work'),
            'work' => Yii::t('common', 'Occupation'),
            'contact' => Yii::t('common', 'Contact'),
        ];
    }

    public function getStatusWork()
    {
        return [
            '1' => 'ครึ่งวัน',
            '2' => 'เต็มวัน',
        ];
    }

    public function getWorkType()
    {
        return $this->hasOne(WorkType::className(), ['id' => 'work_detail']);
    }

    public function getOccupation()
    {
        return $this->hasOne(Occupation::className(), ['id' => 'work']);
    }
}
