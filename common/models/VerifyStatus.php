<?php

namespace common\models;

use Yii;
use common\models\VerifyMember;

/**
 * This is the model class for table "verify_status".
 *
 * @property int $status_id
 * @property string $status_name
 */
class VerifyStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'verify_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_name'], 'required'],
            [['status_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status_name' => 'Status Name',
        ];
    }

    public function getVerifyMember()
    {
        return $this->hasMany(VerifyMember::className(), ['verify_status' => 'status_id']);
    }
}
