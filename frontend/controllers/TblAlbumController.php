<?php

namespace frontend\controllers;

use Yii;
use common\models\TblAlbum;
use common\models\TblAlbumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TblGallery;
use yii\helpers\ArrayHelper;
use common\models\TblGallerySearch;
use yii\db\Query;
use common\models\TblStudio;

/**
 * TblAlbumController implements the CRUD actions for TblAlbum model.
 */
class TblAlbumController extends Controller
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
        ];
    }

    /**
     * Lists all TblAlbum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblAlbumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblAlbum model.
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

    public function actionDetailgallery($id)
    {
        $aid = TblGallery::find()->where(['aID' => $id])->one();
        $albumid = $aid->aID;
        $aidModel = TblGallery::find()->select('*')->where(['aID' => $albumid])->all();
        $searchGallery = new TblGallerySearch();
        $dataProvider = $searchGallery->search($albumid);
        $query = new Query();
        $qid = Yii::$app->user->getId();
        /*ลิงทดสอบ*/
        /*$test = TblStudio::find()->with('userProfile')->one();
        $query->select('id')->from('tbl_studio')->where('u_id = '.$qid.'')->all();
        $command = $query->createCommand();
        $idUser = $command->queryAll();
        foreach ($idUser['0'] as $value) {
            $value;
        }*/
        //$val = TblStudio::findOne($id);
        $modelAlbum = TblAlbum::findOne($id);
        //$valu = $val->userProfile;
        $sid = $modelAlbum->studioID;
        $dirName = 'userid'.$sid;
        $path = Yii::getAlias('@web').'/uploads/user/'.$dirName;

        return $this->render('detailgallery', [
            'model' => $this->findModel($id),
            //'aidHelper' => $aidHelper,
            'dataProvider' => $dataProvider,
            'path' => $path,
            'qid' => $qid,
            'sid' => $sid,
            'modelAlbum' => $modelAlbum,
            //'test' => $test,
        ]);
    }

    /**
     * Creates a new TblAlbum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblAlbum();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->albumID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblAlbum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->albumID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblAlbum model.
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
     * Finds the TblAlbum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblAlbum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblAlbum::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
