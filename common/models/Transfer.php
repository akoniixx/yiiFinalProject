<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transfer".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Transfer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transfer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}