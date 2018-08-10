<?php
namespace backend\controllers;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use common\models\TblStudio;
use common\models\User;

class ReportController extends Controller{

public function actionSumaryReport(){
        // $connection = Yii::$app->db;
        // // $data = $connection->createCommand('
        // //     SELECT month(u.DATETIME_DISCH) as mm,
        // //     COUNT(u.AN) as cnt
        // //     FROM user u
        // //     GROUP BY mm
        // //     ORDER BY mm
        // //     ')->queryAll();
        $data = User::find();
        // //เตรียมข้อมูลส่งให้กราฟ
        // for($i=0;$i<sizeof($data);$i++){
        //     // $yy[] = $data[$i]['yy'];
        //     $mm[] = date('d', $data[$i]['created_at']);
        //     // if (array_values($mm[]) == ) {
        //     //     # code...
        //     // }
        //     // $cnt[] = $data[$i]['cnt'];
        // }
        $sql_sub = "SELECT MONTH(FROM_UNIXTIME(created_at)) as 'month',  YEAR(FROM_UNIXTIME(created_at)) + 543 as 'year', COUNT(id) as 'count' FROM user GROUP BY MONTH(FROM_UNIXTIME(created_at))";

        $queryUser = Yii::$app->db->createCommand($sql_sub)->queryAll();
        Yii::info($queryUser);
        $cnt = null;
        $arrayMonth = [];
        $arrayValue = [];
        foreach ($queryUser as $key => $value) {
            if ($value['month'] == 1) {
                $arrayMonth[] = $value['year'] .'-ม.ค.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 2) {
                $arrayMonth[] = $value['year'] .'-ก.พ.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 3) {
                $arrayMonth[] = $value['year'] .'-มี.ค.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 4) {
                $arrayMonth[] = $value['year'] .'-เม.ย.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 5) {
                $arrayMonth[] = $value['year'] .'-พ.ค.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 6) {
                $arrayMonth[] = $value['year'] .'-มิ.ย.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 7) {
                $arrayMonth[] = $value['year'] .'-ก.ค.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 8) {
                $arrayMonth[] = $value['year'] .'-ส.ค.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 9) {
                $arrayMonth[] = $value['year'] .'-ก.ย.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 10) {
                $arrayMonth[] = $value['year'] .'-ต.ค.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 11) {
                $arrayMonth[] = $value['year'] .'-พ.ย.';
                $arrayValue[] = $value['count'];
            } else if ($value['month'] == 12) {
                $arrayMonth[] = $value['year'] .'-ธ.ค.';
                $arrayValue[] = $value['count'];
            }    
        }

        Yii::info($arrayMonth);
        Yii::info($arrayValue);

        $sql_stu = "SELECT cateWork, MONTH(FROM_UNIXTIME(created_at)) as 'month',  YEAR(FROM_UNIXTIME(created_at)) + 543 as 'year', COUNT(id) as 'count' FROM tbl_categories GROUP BY MONTH(FROM_UNIXTIME(created_at)), cateWork";

        $queryStu = Yii::$app->db->createCommand($sql_stu)->queryAll();
        Yii::info($queryStu);
        $arrayPh = [];
        $arrayMa = [];
        $arrayDr = [];
        foreach ($queryStu as $key => $value) {
            if ($value['cateWork'] == 'Ph') {
                if ($value['month'] == 1) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 2) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 3) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 4) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 5) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 6) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 7) {
                    $arrayPh[] = $value['count'];
                } else if($value['month'] == 8) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 9) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 10) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 11) {
                    $arrayPh[] = $value['count'];
                } else if ($value['month'] == 12) {
                    $arrayPh[] = $value['count'];
                }
            }

            if ($value['cateWork'] == 'Ma') {
                if ($value['month'] == 1) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 2) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 3) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 4) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 5) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 6) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 7) {
                    $arrayMa[] = $value['count'];
                } else if($value['month'] == 8) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 9) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 10) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 11) {
                    $arrayMa[] = $value['count'];
                } else if ($value['month'] == 12) {
                    $arrayMa[] = $value['count'];
                }
            }

            if ($value['cateWork'] == 'Dr') {
                if ($value['month'] == 1) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 2) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 3) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 4) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 5) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 6) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 7) {
                    $arrayDr[] = $value['count'];
                } else if($value['month'] == 8) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 9) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 10) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 11) {
                    $arrayDr[] = $value['count'];
                } else if ($value['month'] == 12) {
                    $arrayDr[] = $value['count'];
                }
            }  
        }

        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data,
            // 'sort'=>[
            //     'attributes'=>['mm','cnt']
            // ],
        ]);
        return $this->render('user',[
            'dataProvider'=>$dataProvider,
            'arrayMonth' => $arrayMonth,
            'arrayValue' => $arrayValue,
            'arrayPh' => $arrayPh,
            'arrayMa' => $arrayMa,
            'arrayDr' => $arrayDr,
        ]);
    }

}