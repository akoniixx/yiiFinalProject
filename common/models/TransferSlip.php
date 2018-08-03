<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transfer_slip".
 *
 * @property int $id
 * @property int $transfer_id
 * @property string $name
 * @property string $studio_name
 * @property string $tel
 * @property string $transfer_time
 * @property int $amount
 * @property string $slip_image
 * @property string $bank_from
 * @property string $bank_to
 * @property string $bank_id
 */
class TransferSlip extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transfer_slip';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transfer_id', 'name', 'amount', 'slip_image'], 'required'],
            [['transfer_id', 'amount'], 'integer'],
            [['transfer_time'], 'safe'],
            [['name', 'slip_image', 'bank_from', 'bank_to'], 'string', 'max' => 255],
            [['studio_name'], 'string', 'max' => 100],
            [['tel'], 'string', 'max' => 10],
            [['bank_id'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transfer_id' => 'Transfer ID',
            'name' => 'Name',
            'studio_name' => 'Studio Name',
            'tel' => 'Tel',
            'transfer_time' => 'Transfer Time',
            'amount' => 'Amount',
            'slip_image' => 'Slip Image',
            'bank_from' => 'Bank From',
            'bank_to' => 'Bank To',
            'bank_id' => 'Bank ID',
        ];
    }
}
