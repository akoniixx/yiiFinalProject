<?php

namespace backend\controllers;

use Yii;
use common\models\GraduationSchedule;
use common\models\GraduationScheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GraduationScheduleController implements the CRUD actions for GraduationSchedule model.
 */
class GraduationScheduleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all GraduationSchedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GraduationScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GraduationSchedule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GraduationSchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GraduationSchedule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        // $ThDay = array ( "อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์" );
        // $ThMonth = array(
        //             "0"=>"",
        //             "1"=>"มกราคม",
        //             "2"=>"กุมภาพันธ์",
        //             "3"=>"มีนาคม",
        //             "4"=>"เมษายน",
        //             "5"=>"พฤษภาคม",
        //             "6"=>"มิถุนายน", 
        //             "7"=>"กรกฎาคม",
        //             "8"=>"สิงหาคม",
        //             "9"=>"กันยายน",
        //             "10"=>"ตุลาคม",
        //             "11"=>"พฤศจิกายน",
        //             "12"=>"ธันวาคม"                 
        //         );
        // $date = "2019-01-02";
        // $sub = substr($date, 0, 4);
        // $sub2 = substr($date, 5, 2);
        // echo $sub+543 . " " . $ThMonth[(int)$sub2];

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing GraduationSchedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GraduationSchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the GraduationSchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GraduationSchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GraduationSchedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
