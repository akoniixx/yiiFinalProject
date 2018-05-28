<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "occupation".
 *
 * @property int $id
 * @property string $occupationName
 * @property string $TH_name
 */
class Occupation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'occupation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['occupationName', 'TH_name'], 'required'],
            [['occupationName', 'TH_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'occupationName' => 'Occupation Name',
            'TH_name' => 'Th Name',
        ];
    }
}
