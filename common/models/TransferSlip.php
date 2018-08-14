<?php

namespace common\models;

use Yii;
use \yii\web\UploadedFile;

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
            [['transfer_id', 'name', 'amount', 'bank_from', 'bank_to', 'transfer_time'], 'required'],
            [['transfer_id', 'amount'], 'integer'],
            [['transfer_time'], 'date'],
            [['slip_image'],  'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            // [['name', 'slip_image', 'bank_from', 'bank_to'], 'string', 'max' => 255],
            [['name', 'bank_from', 'bank_to'], 'string', 'max' => 255],
            [['reservation_date'], 'safe'],
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
            'name' => 'ชื่อ-นามสกุล',
            'reservation_date' => 'วันงานที่คุณจ้าง',
            'tel' => 'เบอร์โทรศัพท์',
            'transfer_time' => 'เวลาที่โอนเงิน',
            'amount' => 'จำนวนเงิน',
            'slip_image' => 'หลักฐานการโอนเงิน',
            'bank_from' => 'ชื่อธนาคารของคุณ',
            'bank_to' => 'ชื่อธนาคารของเว็บไซต์',
            'bank_id' => 'หมายเลข 4 ตัวท้ายของบัญชี',
        ];
    }

    public function bankList()
    {
        return [
            'ธ. กรุงเทพ จำกัด (มหาชน)',
            'ธ. กรุงไทย จำกัด (มหาชน)',
            'ธ. กรุงศรีอยุธยา จำกัด (มหาชน)',
            'ธ. กสิกรไทย จำกัด (มหาชน)',
            'ธ. เกียรตินาคิน จำกัด (มหาชน)',
            'ธ. ซีไอเอ็มบี ไทย จำกัด (มหาชน)',
            'ธ. ทหารไทย จำกัด (มหาชน)',
            'ธ. ทิสโก้ จำกัด (มหาชน)',
            'ธ. ไทยพาณิชย์ จำกัด (มหาชน)',
            'ธ. ธนชาต จำกัด (มหาชน)',
            'ธ. นครหลวงไทย จำกัด (มหาชน)',
            'ธ. ยูโอบี จำกัด (มหาชน)',
            'ธ. สแตนดาร์ดชาร์เตอร์ด (ไทย) จำกัด (มหาชน)',
            'ธนาคารไอซีบีซี (ไทย) จำกัด (มหาชน)',
        ];
    }

    public function bankListTo()
    {
        return [
            'ธ. กรุงเทพ จำกัด (มหาชน)',
            'ธ. กรุงไทย จำกัด (มหาชน)',
            'ธ. กรุงศรีอยุธยา จำกัด (มหาชน)',
            'ธ. กสิกรไทย จำกัด (มหาชน)',
        ];
    }

    public function uploadImages($model, $attr, $id)
    {
        $image = UploadedFile::getInstance($model, $attr);
        $path = Yii::getAlias('@app').'/web/uploads/transfer_slip/';
        $date = date("Y-m-d");
        $time = date("h-i-s");
        $dateTime = $date . "_" . $time;
        if ($image !== NULL) {
            if ($attr == 'slip_image') {
                $fileName = $attr.$id.'_'.$dateTime.'.'.$image->extension;
            } else {
                $fileName = $attr.$id.'_'.$dateTime.'.'.$image->extension;
            }
            if ($image->saveAs($path.$fileName)) {
                return $fileName;
            }   
            //return $fileName; 
        }
    }
}
