<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work_type".
 *
 * @property int $id
 * @property string $name_type
 * @property string $name_type_TH
 */
class WorkType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_type', 'name_type_TH'], 'required'],
            [['name_type', 'name_type_TH'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_type' => 'Name Type',
            'name_type_TH' => 'Name Type  Th',
        ];
    }

    // public function getWorkType()
    // {
        
    // }
}
