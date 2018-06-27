<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "graduation_details".
 *
 * @property int $id
 * @property string $initials
 * @property string $detail
 */
class GraduationDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graduation_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['initials'], 'string', 'max' => 2],
            [['detail'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'initials' => 'Initials',
            'detail' => 'Detail',
        ];
    }

    public function getGraduationSchedule()
    {
        return $this->hasMany(GraduationSchedule::className(), ['details' => 'initials']);
    }
}
