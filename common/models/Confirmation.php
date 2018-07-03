<?php

namespace common\models;

use Yii;
use common\models\TblStudio;

/**
 * This is the model class for table "confirmation".
 *
 * @property int $confirm_id
 * @property string $confirm_name
 */
class Confirmation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const NONE_VERIFY = 1;
    const VERIFY = 40;

    public static function tableName()
    {
        return 'confirmation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['confirm_name'], 'required'],
            [['confirm_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'confirm_id' => 'Confirm ID',
            'confirm_name' => 'Confirm Name',
        ];
    }

    public function getStudioStatus()
    {
        return $this->hasMany(TblStudio::className(), ['confirmation' => 'confirm_id']);
    }
}
