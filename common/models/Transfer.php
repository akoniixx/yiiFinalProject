<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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

    public $name;
    public $reservation_date;
    public $tel;
    public $bank_from;
    public $transfer_time;
    public $bank_to;
    public $amount;
    public $slip_image;
    public $bank_id;

    const STATUS_WAIT = 1;
    const STATUS_ACTIVE = 20;
    const STATUS_DELETE = 0;

    public static function tableName()
    {
        return 'transfer';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
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
            'name' => 'ชื่อลูกค้า',
            'tel' => 'เบอร์โทร',
            'reservation_date' => 'วันที่จองงาน',
            'bank_from' => 'ธนาคารต้นทาง',
            'bank_to' => 'ธนาคารปลายทาง',
            'bank_id' => 'รหัส 4 ตัวท้ายของเลขบัญชี',
            'amount' => 'จำนวนเงิน',
            'slip_image' => 'หลักฐานการโอนเงิน',
            'transfer_time' => 'เวลาที่โอนเงิน',
        ];
    }

    public function getTransferList()
    {
        return $this->hasOne(TransferSlip::className(), ['transfer_id' => 'id']);
    }
}
