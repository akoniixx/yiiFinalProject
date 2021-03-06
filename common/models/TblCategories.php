<?php

namespace common\models;

use Yii;
use common\models\TblStudio;
use common\models\Occupation;

/**
 * This is the model class for table "tbl_categories".
 *
 * @property int $id
 * @property int $s_id
 * @property string $cateWork
 * @property string $workDetails
 * @property string $placeOfWork
 */
class TblCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
     public $listDetail;

    public static function tableName()
    {
        return 'tbl_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_id', 'cateWork', 'workDetails', 'placeOfWork'], 'required'],
            [['s_id'], 'integer'],
            [['workDetails'], 'string'],
            [['cateWork'], 'string', 'max' => 30],
            [['workDetails'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_id' => 'S ID',
            'cateWork' => 'อาชีพ',
            'workDetails' => 'รายละเอียดงาน',
            'placeOfWork' => 'สถานที่รับงาน',
        ];
    }

    public function addOccupation()
    {
        $oc = ['Photographer' => 'ช่างภาพ', 'MakeupArtist' => 'ช่างแต่งหน้า', 'DreesRental' => 'ร้านเช่าชุด'];
        return $oc;
    }

    public function arrOccupation()
    {
        $oc = ['0' => 'Photographer', '1' => 'MakeupArtist', '2' => 'DreesRental'];
        return $oc;
    }

    public function searchOccupation($id)
    {
        $search = TblCategories::find()->where(['s_id' => $id])->all();
        $arrayItem = array();
        foreach ($search as $key => $value) {
            $item = new TblCategories();
            $item->cateWork = $value['cateWork'];
            $arrayItem[] = $item->cateWork;
        }
        //$search = TblCategories::find(['id' => $id])->orderBy(['id' => SORT_DESC])->all();
        return $arrayItem;
    }

    public function getStudio()
    {
        return $this->hasOne(TblStudio::className(), ['id' => 's_id']);
    }

    public function getOccupations()
    {
        return $this->hasMany(Occupation::className(), ['initials' => 'cateWork']);
    }
}
