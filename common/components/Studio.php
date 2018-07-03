<?php

namespace common\components;

use Yii;
use yii\base\Component;
use common\models\TblStudio;
 
class Studio extends Component {
     
    public $getProperty = 'Get Property';
     
    public function getStudioID()
    {
    	$id = Yii::$app->user->getId();
    	$stu = TblStudio::find()->where(['u_id' => $id])->one();
    	if (isset($stu)) {
    		return $stu->id;
    	}
        return false;
    }
     
}

?>