<?php

namespace common\models;

use Yii;
use common\models\University;
use common\models\GraduationDetails;
use common\models\WorkSchedule;

/**
 * This is the model class for table "graduation_schedule".
 *
 * @property int $id
 * @property string $schedule
 * @property string $details
 * @property string $date
 */
class GraduationSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'graduation_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['schedule'], 'required'],
            [['date'], 'safe'],
            [['schedule', 'details'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schedule' => 'รายชื่อมหาลัย',
            'details' => 'รายละเอียด',
            'date' => 'วันที่',
        ];
    }

    public function formatGraduationDate($data)
    {
        $date = null;
        $ThDay = array ( "อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์" );
        $ThMonth = array(
                    "0"=>"",
                    "1"=>"มกราคม",
                    "2"=>"กุมภาพันธ์",
                    "3"=>"มีนาคม",
                    "4"=>"เมษายน",
                    "5"=>"พฤษภาคม",
                    "6"=>"มิถุนายน", 
                    "7"=>"กรกฎาคม",
                    "8"=>"สิงหาคม",
                    "9"=>"กันยายน",
                    "10"=>"ตุลาคม",
                    "11"=>"พฤศจิกายน",
                    "12"=>"ธันวาคม"                 
                );
        $date = $data;
        $year = (int)substr($date, 0, 4) + 543;
        $month = substr($date, 5, 2);
        $day = strtotime($date);
        return "วันที่ " . date("j", $day) . " " . $ThMonth[(int)$month] . " " . $year;
    }

    public function getGraduationDetails()
    {
        return $this->hasOne(GraduationDetails::className(), ['initials' => 'details']);
    }

    public function getUniversity()
    {
        return $this->hasOne(University::className(), ['id' => 'schedule']);
    }

    public function getWorkSchedule()
    {
        // $studioId = Yii::$app->studio->getStudioId();
        // $work = WorkSchedule::find()->where(['s_id' => $studioId]);
        // return $work;
        return $this->hasOne(WorkSchedule::className(), ['graduation_id' => 'id']);
    }
}
