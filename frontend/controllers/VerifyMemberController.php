<?php

namespace frontend\controllers;

use Yii;
use common\models\VerifyMember;
use common\models\VerifyMemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\behaviors\TimestampBehavior;
/**
 * VerifyMemberController implements the CRUD actions for VerifyMember model.
 */
class VerifyMemberController extends Controller
{
    /**
     * @inheritdoc
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
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * Lists all VerifyMember models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VerifyMemberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $path = Yii::getAlias('@web').'/web/uploads/verify/';

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'path' => $path,
        ]);
    }

    /**
     * Displays a single VerifyMember model.
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
     * Creates a new VerifyMember model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VerifyMember();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->verify_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VerifyMember model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->verify_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing VerifyMember model.
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

    public function actionVerifymember($id)
    {
        $uploadModel = new VerifyMember();

        if ($uploadModel->load(Yii::$app->request->post())) {

            $idcard = $uploadModel->uploadImages($uploadModel, 'img_idCard', $id);
            $profile = $uploadModel->uploadImages($uploadModel, 'img_profile', $id);
            $uploadModel->img_idCard = $idcard;
            $uploadModel->img_profile = $profile;
            $uploadModel->studio_id = $id;

            if($uploadModel->save(false)) {
                //Yii::$app->db->createCommand()->update('tbl_studio', ['confirmation' => 'verified'], 'id = '.$id.'')->execute();
                return $this->redirect(['completed', 'id' => $id]);
            } else {
                return $uploadModel->getErrors();
            }
        }

        return $this->render('verifymember',[
            'uploadModel' => $uploadModel,
        ]);
    }

    public function actionCompleted($id)
    {
        return $this->render('completed', ['id' => $id]);
    }

    public function actionConfirm_validation($id)
    {
        $vid = VerifyMember::findOne($id);
        $sid = $vid->studio_id;
        Yii::$app->db->createCommand()->update('tbl_studio', ['confirmation' => 30], 'id = '.$sid.'')->execute();
        Yii::$app->db->createCommand()->update('verify_member', ['verify_status' => 50], 'studio_id = '.$sid.'')->execute();
        Yii::$app->session->setFlash('success', 'อับเดทสถานะของลูกค้าเสร็จสิ้น');
        return $this->redirect(['view', 'id' => $id]);
    }

    /**
     * Finds the VerifyMember model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VerifyMember the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VerifyMember::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
