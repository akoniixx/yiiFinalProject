<?php

namespace frontend\controllers;

use Yii;
use common\models\Reservations;
use common\models\ReservationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\ReservationDetail;
use common\models\TblCategories;
use common\models\Occupation;
use yii\helpers\Json;
use common\models\WorkType;

/**
 * ReservationsController implements the CRUD actions for Reservations model.
 */
class ReservationsController extends Controller
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
     * Lists all Reservations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReservationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reservations model.
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
     * Creates a new Reservations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $get = Yii::$app->request->get();
        $model = new Reservations();
        $modelDetail = new ReservationDetail();
        $findCategory = TblCategories::find()->where(['s_id' => $get['id']])->all();
        // return Yii::$app->user->getId();

        Yii::info('reservation Sql');
        Yii::info($findCategory);
        // print_r($findCategory);
        $arrayId = [];
        $arrayWorkDetail = [];
        $arrayName = [];
        $arrOccupation = [];
        $arrayKey = [];
        foreach ($findCategory as $key => $value) {
            if ($value->cateWork != 'Dr') {
                $arrayName[] = $value->cateWork;
                $arrayWorkDetail[] = Json::decode($value->workDetails);
                $arrayId[] = $value->id;
            }
        }
        Yii::info($arrayWorkDetail);
        
        foreach ($arrayWorkDetail as $key => $value) {
            $arrayKey[] = array_keys($value);
        }
        // $newArrayKey = array_combine(array_values($arrayKey[0]), array_values($arrayKey[0]));
        // Yii::info(array_values($arrayValue[0]));
        Yii::info(array_values($arrayKey[0]));
        Yii::info($arrOccupation);
        // Yii::info($newArrayKey);
        $findWorkType = WorkType::find()->where(['name_type' => $arrayKey[0]])->all();
        Yii::info($findWorkType);
        // return print_r($arrayWorkDetail);
        $findOccupation = Occupation::find()->where(['initials' => $arrayName])->all();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        if ($modelDetail->load(Yii::$app->request->post())) {
            $get = Yii::$app->request->get();
            $model->user_id = Yii::$app->user->getId();
            $model->studio_id = $get['id'];
            if ($model->save()) {
                $modelDetail->reservation_id = $model->id;
                if ($modelDetail->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                $model->delete();
                return "save detail fail";
            }
            return "save fail";
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'modelDetail' => $modelDetail,
            'findCategory' => $findCategory,
            'findOccupation' => $findOccupation,
            'findWorkType' => $findWorkType,
            // 'arrOccupation' => 
        ]);
    }

    public function actionList()
    {
        $searchModel = new ReservationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Reservations model.
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
     * Deletes an existing Reservations model.
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
     * Finds the Reservations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Reservations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reservations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
