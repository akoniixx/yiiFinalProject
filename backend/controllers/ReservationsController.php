<?php

namespace backend\controllers;

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
use yii\data\ActiveDataProvider;
use common\models\UProfile;

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
        $id = null;
        $status = 'admin';
        $searchModel = new ReservationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id, $status);
        $updateNow = Yii::$app->db->createCommand()
                    ->update('reservations', ['admin_view' => 1], 'status = '. '"'.Reservations::CONFIRM.'"')
                    // ->update('reservations', ['admin_view' => 0])
                    ->execute();

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
        $modelDetail = ReservationDetail::find()->where(['reservation_id' => $id])->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelDetail' => $modelDetail,
        ]);
    }

    public function actionConfirm($id)
    {
        $modelDetail = ReservationDetail::find()->where(['reservation_id' => $id])->one();
        $model = $this->findModel($id);
        $model->status = Reservations::CONFIRM;
        $studioId = Yii::$app->studio->getStudioId();
        if ($model->save()) {
            $find_res = Reservations::find()
                ->leftJoin('reservation_detail', 'reservations.id = reservation_detail.reservation_id')
                ->where([
                    'reservations.studio_id' => $studioId,
                    'reservations.status' => Reservations::PENDING,
                ])
                ->andWhere([
                    'reservation_detail.reservation_date' => $modelDetail->reservation_date
                ])->all();
            $arr = [];
            Yii::info($find_res);
            if (isset($find_res)) {
                foreach ($find_res as $key => $value) {
                    $newFindRes = Reservations::find()->where([
                        'id' => $value->id
                    ])->one();
                    $newFindRes->status = Reservations::DELETE;
                    $newFindRes->save();
                    // $arr[] = $newFindRes->id;
                }
            }
            // Yii::info($arr);
            // return true;
            Yii::$app->session->setFlash('success', Yii::t('common', 'Confirmation success'));
            return $this->render('view', [
                'model' => $model,
                'modelDetail' => $modelDetail,
            ]);
        }
        Yii::$app->session->setFlash('error', Yii::t('common', 'Confirmation failed'));
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelDetail' => $modelDetail,
        ]); 
    }

    public function actionWorkSchedule($id)
    {
        $model = Reservations::find()->where(['studio_id' => $id, 'status' => Reservations::CONFIRM])->all();
        $arrayId = [];
        foreach ($model as $value) {
            $arrayId[] = $value->id;
        }

        $modelDetail = ReservationDetail::find()->where(['reservation_id' => $arrayId])->all();

        $events = array();

        foreach ($modelDetail AS $time){
          $hours = $time->type == ReservationDetail::ALL_DAY ? Yii::t('common', 'All day') : Yii::t('common', 'Half day');
          $event = new \yii2fullcalendar\models\Event();
          $event->id = $time->id;
          $event->title = $time->workType->name_type_TH . " [" . $hours ."]";
          $event->backgroundColor = 'red';
          // $event->durationEditable = true;
          // $event->color = 'yellow';
          $event->start = $time->reservation_date;
          // $Event->end = date('Y-m-d\TH:i:s\Z',strtotime($time->date_end.' '.$time->time_end));
          $events[] = $event;
        }

        $searchModel = new ReservationsSearch();
        $query = Reservations::find()->where(['studio_id' => $id, 'status' => Reservations::CONFIRM]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
        ]);

        return $this->render('work_schedule', [
            'events' => $events,
            'id' => $id,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        // return $get['date'];
        $model = new Reservations();
        $modelDetail = new ReservationDetail();
        $findCategory = TblCategories::find()->where(['s_id' => $get['id']])->all();
        // return Yii::$app->user->getId();
        $userModel = UProfile::findOne(Yii::$app->user->getId());
        $currentDate = null;
        if (isset($get['date'])) {
            $currentDate = $get['date'];
        }

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
                if (isset($get['date'])) {
                    $modelDetail->reservation_date = $get['date'];
                }
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
            'currentDate' => $currentDate,
            'userModel' => $userModel,
        ]);
    }

    public function actionList($id)
    {
        $searchModel = new ReservationsSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->studio->getStudioId() != NULL) {
            $query = Reservations::find()->where(['studio_id' => $id]);
            $now = date('Y-m-d H:i:s');
            // return $now;
            $updateNow = Yii::$app->db->createCommand()
                    ->update('reservations', ['status_view' => Reservations::VISITED], 'studio_id = '.$id.' AND create_time <='.'"'.$now.'"')
                    ->execute();
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => false,
                'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            ]);

            return $this->render('list', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id' => $id,
            ]);
        } else {
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
            $arrayModel = new Reservations();
            return $this->render('status_list', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'id' => $id,
                'arrayModel' => $arrayModel,
            ]);
        }
        
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
