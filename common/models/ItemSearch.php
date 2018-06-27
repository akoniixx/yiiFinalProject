<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 */
class ItemSearch extends \yii\base\Model
{
    public $text;
    public $occupation;
    public $typeOfWork;
    public $province;
    public $budget;
    public $workHours;

    public function rules()
    {
        return [
            ['text', 'occupation', 'typeOfWork', 'province', 'budget', 'workHours'],
        	
        ];
    }
}