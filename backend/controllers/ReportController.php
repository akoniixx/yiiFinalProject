<?php
namespace backend\controllers;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use common\models\TblStudio;

class ReportController extends Controller{

public function actionReport(){
        $connection = Yii::$app->db;
        // $data = $connection->createCommand('
        //     SELECT month(u.DATETIME_DISCH) as mm,
        //     COUNT(u.AN) as cnt
        //     FROM user u
        //     GROUP BY mm
        //     ORDER BY mm
        //     ')->queryAll();
        $data = User::find()->groupBy(['created_at'])->orderBy(['created_at'])->count();
        //เตรียมข้อมูลส่งให้กราฟ
        for($i=0;$i<sizeof($data);$i++){
            // $yy[] = $data[$i]['yy'];
            $mm[] = date('d', $data[$i]['created_at']);
            // if (array_values($mm[]) == ) {
            //     # code...
            // }
            // $cnt[] = $data[$i]['cnt'];
        }
        $cnt = null;
        Yii::info('month');
        Yii::info($mm);
        return var_dump($mm);
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            // 'sort'=>[
            //     'attributes'=>['mm','cnt']
            // ],
        ]);
        return $this->render('user',[
            'dataProvider'=>$dataProvider,
            'mm'=>$mm,'cnt'=>$cnt,
        ]);
    }

}