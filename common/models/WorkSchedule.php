<?php

namespace common\models;

use Yii;
use common\models\GraduationSchedule;

/**
 * This is the model class for table "work_schedule".
 *
 * @property int $id
 * @property int $graduation_id
 * @property int $s_id
 * @property string $typeOfWork
 * @property string $created_at
 */
class WorkSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    const PHOTOGRAPHER = "Ph";
    const MAKEUP_ARTIST = "Ma";

    public $cnt;
    public $userProfile;
    public $categories;
    public $occupations;
    public $confirmStatus;
    public $studio;

    public static function tableName()
    {
        return 'work_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['graduation_id', 's_id', 'typeOfWork'], 'required'],
            [['graduation_id', 's_id'], 'integer'],
            [['created_at'], 'safe'],
            [['typeOfWork'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'graduation_id' => 'Graduation ID',
            's_id' => 'S ID',
            'typeOfWork' => 'Type Of Work',
            'created_at' => 'Created At',
        ];
    }

    public function getGraduation()
    {
        return $this->hasOne(GraduationSchedule::className(), ['id' => 'graduation_id']);
    }

    public function getStudio()
    {
        return $this->hasOne(TblStudio::className(), ['id' => 's_id']);
    }
}
