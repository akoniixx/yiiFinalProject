<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property int $location_id
 * @property string $location_name
 * @property string $location_geo
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $item;

    public static function tableName()
    {
        return 'locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_name', 'location_geo'], 'required'],
            [['location_name'], 'string', 'max' => 255],
            [['location_geo'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'location_id' => 'Location ID',
            'location_name' => 'Location Name',
            'location_geo' => 'Location Geo',
        ];
    }
}
