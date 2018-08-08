<?php

namespace backend\controllers;

use Yii;
use common\models\Transfer;
use common\models\TransferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TransferSlip;
use common\models\UProfile;
use yii\web\BadRequestHttpException;

/**
 * TransferController implements the CRUD actions for Transfer model.
 */
class TransferController extends Controller
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
     * Lists all Transfer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $updateNow = Yii::$app->db->createCommand()
                    ->update('transfer', ['status_view' => 0])
                    ->execute();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transfer model.
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
     * Creates a new Transfer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $transferModel = new Transfer();
        $slipModel = new TransferSlip();
        $user = UProfile::findOne($id);
        if ($slipModel->load(Yii::$app->request->post())) {
            // return "now";
            // $transferModel->user_id = Yii::$app->user->getId();
            $transferModel->user_id = $id;
            if ($transferModel->save()) {
                $slip_image = $slipModel->uploadImages($slipModel, 'slip_image', $id);
                $slipModel->transfer_id = $transferModel->id;
                $slipModel->slip_image = $slip_image;
                if (Yii::$app->request->post('datetime_11')) {
                    $dateTime = Yii::$app->request->post('datetime_11');
                    $newDate = date("Y-m-d h-i-s", strtotime($dateTime));
                    $slipModel->transfer_time = $newDate;
                }
                if ($slipModel->save(false)) {
                    Yii::$app->session->setFlash('success', 'ยืนยันการส่งข้อมูงเสร็จสิ้น');
                    $searchModel = new TransferSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'id' => $id,
                    ]);
                    // return $this->redirect(['view', 'id' => $transferModel->id]);
                }
                $transferModel->delete();
                Yii::$app->session->setFlash('danger', 'ส่งข้อมูลไม่สำเร็จ กรุณาลองอีกครั้ง');
                throw new BadRequestHttpException("Value isn't save");
            }
        }

        return $this->render('create', [
            'transferModel' => $transferModel,
            'slipModel' => $slipModel,
            'user' => $user,
        ]);
    }

    /**
     * Updates an existing Transfer model.
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

    public function actionConfirm($id)
    {
        $model = $this->findModel($id);
        $model->status = Transfer::STATUS_ACTIVE;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('common', 'Confirmation success'));
            $searchModel = new TransferSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Deletes an existing Transfer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $findModel = Transfer::find($id);
        $findModel->status = Transfer::STATUS_DELETE;
        if ($findModel->save()) {
            return $this->redirect(['index']);
        }
        
    }

    /**
     * Finds the Transfer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transfer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transfer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
