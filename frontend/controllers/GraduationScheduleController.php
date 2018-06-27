<?php

namespace frontend\controllers;

use Yii;
use common\models\GraduationSchedule;
use common\models\GraduationScheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use common\models\TblCategories;
use common\models\WorkSchedule;

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
        $studioId = Yii::$app->studio->getStudioId();
        $category = TblCategories::find()->where(['s_id' => $studioId])->all();
        $cateWork = array();
        $work = WorkSchedule::find()->where(['s_id' => $studioId])->all();
        $arrWork = array();
        if (isset($work)) {
            foreach ($work as $key => $value) {
                $arrWork[] = $value->graduation_id;
            }
        }

        foreach ($category as $key => $value) {
            $cateWork[] = $value->cateWork;
        }

        $post = Yii::$app->request->post();
        if ($searchModel->load($post) && isset($post)) {
            // return "yes";
            $model = new WorkSchedule();        
            $request = "";
            $type = "";
            if (isset($post['submit_ph'])) {
                $request = $post['submit_ph'];
                $type = "Ph";
            } else {
                $request = $post['submit_ma'];
                $type = "Ma";
            }

            $model->graduation_id = $request;
            $model->s_id = $studioId;
            $model->typeOfWork = $type;
            // return $model;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('notifications', 'Successfully Added'));
                return $this->redirect(['index', 'studioId' => $studioId]);
            }

        }

        // return "no";

        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        //     'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
        //     'pagination' => [ 'pageSize' => 20 ]
        // ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cateWork' => $cateWork,
            'studioId' => $studioId,
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

    public function actionViewAll()
    {
        // $searchModel = new GraduationScheduleSearch();
        // $query = GraduationSchedule::find()->limit(5);

        // $dataProvider = new ActiveDataProvider([
        //     'query' => $query,
        //     'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
        //     'pagination' => [ 'pageSize' => 20 ]
        // ]);

        // return $this->render('view-all', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);

        $searchModel = new GraduationScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view-all', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    // public function actionJoinGraduate()
    // {
    //     $model = new WorkSchedule();
    //     $studioId = Yii::$app->studio->getStudioId();
    //     $post = Yii::$app->request->post();
    //     $request = "";
    //     $type = "";
    //     if (isset($post)) {
    //         // return $post['submit'];
    //         if (isset($post['submit_ph'])) {
    //             $request = $post['submit_ph'];
    //             $type = "Ph";
    //         } else {
    //             $request = $post['submit_ma'];
    //             $type = "Ma";
    //         }

    //         $model->graduation_id = $request;
    //         $model->s_id = $studioId;
    //         $model->typeOfWork = $type;

    //         if ($model->save()) {
    //             Yii::$app->session->setFlash('success', Yii::t('norifications', 'Successfully Added'));
    //             return $this->redirect(['index', 'data' => $model->graduation_id]);
    //         }

    //     }
    //     return $this->render('index');
    // }

    /**
     * Deletes an existing GraduationSchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $work = WorkSchedule::findOne(['graduation_id' => $id]);
        if (isset($work)) {
            $work->delete();
        }
        Yii::$app->session->setFlash('error', Yii::t('notifications', 'Delete Successfully'));
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
