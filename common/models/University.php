<?php

namespace common\models;

use Yii;
use common\models\GraduationSchedule;

/**
 * This is the model class for table "university".
 *
 * @property int $id
 * @property string $name
 */
class University extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'university';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    public function getGraduationSchedule()
    {
        return $this->hasOne(GraduationSchedule::className(),['schedule' => 'id']);
    }
}
