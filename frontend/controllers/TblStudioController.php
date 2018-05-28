<?php

namespace frontend\controllers;

use Yii;
use common\models\TblStudio;
use common\models\TblStudioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TblGallery;
use common\models\TblAlbum;
use yii\db\Query;
use common\models\User;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\widgets\ActiveField;
use common\models\UProfile;
use common\models\Locations;
use common\models\TblCategories;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\data\ActiveDataProvider;
use common\models\TblAlbumSearch;
/*use common\models\VerifyMember;
use common\models\VerifyMemberSearch;*/
/**
 * TblStudioController implements the CRUD actions for TblStudio model.
 */
class TblStudioController extends Controller
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
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),//กำหนดค่า หรืออาจใช้ค่าอย่างอื่นที่ return เป็น timestamp ก็ได้
            ],
        ];
    }

    /**
     * Lists all TblStudio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblStudioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

   /* public function actionUploadform()
    {
        $upload = new TblGallery();
        $id = new User();
        $query = new Query();
        $id = Yii::$app->user->getId();
        $query->select('email')->from('user')->where('id = '.$id.'')->all();
        $command = $query->createCommand();
        $name = $command->queryAll();
        foreach ($name['0'] as $value) {
            $value;
        }

        if ($upload->load(Yii::$app->request->post())) {
            $upload->gimages = UploadedFile::getInstances($upload, 'gimages');
            if ($upload->gimages && $upload->validate()) {
                $path = '@app/uploads/user/'. $value;
                FileHelper::createDirectory($path);
                $upload->gimages->saveAs($path .'/'. $upload->gimages->baseName . '.' . $upload->gimages->extension);
                return true;
            } else {
                return false;
            }
            return $this->render('uploadform');
        }
        return $this->render('uploadform',[
            'upload' => $upload,
            'name' => $name,
            'id' => $id,
        ]);
    }*/

    public function actionUploadform($id)
    {
        $album = new TblAlbum();
        $model = new TblGallery();
        $studio = new TblStudio();
        $query = new Query();
        $qid = Yii::$app->user->getId();
        $query->select('id')->from('tbl_studio')->where('u_id = '.$qid.'')->all();
        $command = $query->createCommand();
        $idUser = $command->queryAll();
        foreach ($idUser['0'] as $value) {
            $value;
        }
        $albumName = 'Success';
        $cateAlubm = 'wedding';

        /*if ($album->load(Yii::$app->request->post())) {
            
            
            if ($album->save()) {
                return "save";
            } else {
                return "not save";
            }
        }*/

        /*$id = new User();
        $query = new Query();
        $id = Yii::$app->user->getId();
        $query->select('email')->from('user')->where('id = '.$id.'')->all();
        $command = $query->createCommand();
        $name = $command->queryAll();
        foreach ($name['0'] as $value) {
            $value;
        }*/

        $sid = TblStudio::findOne($id);
        //$modelStudio = TblStudio::findOne($id);

        if ($album->load(Yii::$app->request->post())) {
            $model->gimages = UploadedFile::getInstances($model, 'gimages');
            //$path = Yii::getAlias('@app').'/uploads/user/';
            $dirName = 'userid'.$value;
            $path = Yii::getAlias('@app').'/web/uploads/user/'.$dirName;
            FileHelper::createDirectory($path);

            $album->studioID = $sid->id;
            $album->image = $dirName.$model->gimages[0];
            $album->status = 'process';
            $arr = array();
            if($album->save()) {
                foreach ($model->gimages as $file) {
                    $newGallery = new TblGallery();
                    $newGallery->aID = $album->albumID;
                    $newGallery->status = 'process';
                    $newGallery->gName = $album->albumName;
                    $imgFullName = $dirName . $file->baseName . '.' . $file->extension;
                    //$file->saveAs($path . '/' . $value . $imgFullName);
                    $newGallery->gimages = $imgFullName;
                    /*$model->save();*/
                    if ($newGallery->save(false)) {
                        $file->saveAs($path . '/' . $imgFullName);
                    }
                    $arr[] = $imgFullName;
                }

                return print_r($arr);
            } else {
                return "upload fail.";
            }
            
            //if ($model->upload($value)) {
            
            //if ($album->validate()) {
                
                
                //return $album->albumName . " " . $album->type." ". $album->status;
                
            //}   
                //return $path;
            //}
        }

        return $this->render('uploadform', [
            'model' => $model,
            'album' => $album,
        ]);
    }

    /**
     * Displays a single TblStudio model.
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
     * Creates a new TblStudio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblStudio();
        $profile = new UProfile();
        $item = new Locations();
        $cate = new TblCategories();
        $occupation = $cate->addOccupation();
        $query = new Query();
        $id = Yii::$app->user->getId();
        $query->select('*')->from('uProfile')->where('u_id = '.$id.'')->all();
        $command = $query->createCommand();
        $name = $command->queryAll();
        foreach ($name as $value) {
            //$profile->email = $value['email'];
            $profile->u_id = $value['u_id'];
        }
        if ($model->load(Yii::$app->request->post())) {
            //return $this->redirect(['view', 'id' => $model->id]);
            //return $profile->email $profile->tel;
            //$model->email = $profile->email;
            //$model->tel = $profile->tel;

            //$transaction = Yii::$app->db->beginTransaction();
            //try {
            $model->u_id = $profile->u_id;
            $cate->s_id = $model->id;
            if ($model->save()) {
                //$transaction->commit();
                //return $this->render(['view', 'id' => $model->id]);
                $cate->s_id = $model->id;

                if ($cate->load(Yii::$app->request->post())) {
                $ar = $cate->workDetails;
                $pow = $cate->placeOfWork;
                $arr = array();
                $arr_results = array();

                $it = Yii::$app->request->post();
                //$arr = array();
                $listDetail = $cate->placeOfWork;
                if (is_array($listDetail)) {
                   foreach ($it['TblCategories']['placeOfWork'] as $key => $val) {
                        $arr[] = $val;
                    }
                }
                $cate->placeOfWork = json_encode($arr, JSON_UNESCAPED_UNICODE);
                //return print_r(json_decode($js));
                //return $js;

                foreach( $ar as $val )
                {
                  if( $val )
                  {
                    $arr_results[] = $val ;
                  }
                }
                $cate->workDetails = json_encode($arr_results);

                //return $js . " " . $js2. " ". $cate->cateWork;
                }

                if ($cate->save()) {
                    //return $this->redirect('index');
                    Yii::$app->db->createCommand()->update('uprofile', ['userType' => 'P'], 'id = '.$model->u_id.'')->execute();
                    return $this->redirect(['fanpage', 'id' => $model->id]);
                }
            }

                
                
                

            /*}  catch (\Exception $e) {
                $transaction->rollBack();
                return "fail";
            }*/
            //return $model->email . $model->tel;
        }

        return $this->render('create', [
            'model' => $model,
            'profile' => $profile,
            'item' => $item,
            'cate'=> $cate,
            'occupation' => $occupation,
        ]);
    }

    /**
     * Updates an existing TblStudio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cate = new TblCategories();
        $occupation = $cate->addOccupation();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'cate' => $cate,
            'occupation' => $occupation,
        ]);
    }

    /**
     * Deletes an existing TblStudio model.
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

    public function actionFanpage($id)
    {
        $modelCategory = TblCategories::findOne($id);
        $modelStudio = TblStudio::findOne($id);
        $modelAlbum = TblAlbum::findOne(['studioID' => $id]);
        $pid = $modelStudio->u_id;
        $textStatus = $modelStudio->confirmStatus;
        $modelProfile = UProfile::findOne($pid);
        $searchAlbum = new TblAlbumSearch();
        $dataProvider = $searchAlbum->search(Yii::$app->request->queryParams, $id);
        $dataProvider->pagination->pageSize = 12;
        $dataProvider->sort->defaultOrder = ['albumID' => 'DESC'];
        if ($modelAlbum !== NULL) {
            $baseUrl = Yii::getAlias('@web').'/uploads/user/'.'userid'.$modelStudio->id.'/';
            /*$length = strlen($modelAlbum->albumName);
            if ($length > 15) {
                $substr = substr($modelAlbum->albumName, 0, 15);
                $aName = $substr.'...';
            } else {
                $aName = $modelAlbum->albumName;
            }*/
        } else {
            $baseUrl = NULL;
            //$aName = NULL;
        }

        $test = TblStudio::findOne($id);
        $tt = $test->userProfile;
        $uploadImg = new UProfile;
        
        

        return $this->render('fanpage', [
            'modelCategory' => $modelCategory,
            'modelStudio' => $modelStudio,
            'modelProfile' => $modelProfile,
            'searchAlbum' => $searchAlbum,
            'dataProvider' => $dataProvider,
            'modelAlbum' => $modelAlbum,
            //'aName' => $aName,
            'baseUrl' => $baseUrl,
            'id' => $id,
            'tt' => $tt,
            'uploadImg' => $uploadImg,
            'textStatus' => $textStatus,
        ]);
    }

    public function actionUploadimage()
    {
        $this->enableCsrfValidation = false;
        return "yes";
    }

    public function actionCreatenewcareer()
    {
        $modelStudio = new TblStudio();
        $cate = new TblCategories();
        $occupation = $cate->arrOccupation();
        $sid = $modelStudio->getIDPartner();
        $listOcc = $cate->searchOccupation($sid->id);
        $add = array();
        array_push($add, $listOcc->cateWork);
        $arrDiff = array_diff($occupation, $add);

        if ($cate->load(Yii::$app->request->post())) {
            if ($cate->cateWork == 0) {
                $cate->cateWork = "Photographer";
            } else if ($cate->cateWork == 1) {
                $cate->cateWork = "MakeupArtist";
            } else {
                $cate->cateWork = "DreesRental";
            }
            $cate->s_id = $sid->id;
            $ar = $cate->workDetails;
            $arr = array();
            $arr_results = array();

            $it = Yii::$app->request->post();
            //$arr = array();
            $listDetail = $cate->placeOfWork;
            if (is_array($listDetail)) {
               foreach ($it['TblCategories']['placeOfWork'] as $key => $val) {
                    $arr[] = $val;
                }
            }
            $cate->placeOfWork = json_encode($arr);

            foreach( $ar as $val )
            {
              if( $val )
              {
                $arr_results[] = $val ;
              }
            }
            $cate->workDetails = json_encode($arr_results);
            if ($cate->save()) {
                //return 'success';
                return $this->redirect(['fanpage', 'id' => $cate->s_id]);
            } else {
                return 'fail';
            }
            //return $cate->s_id;
        }

        return $this->render('createnewcareer',[
            'occupation' => $occupation,
            'cate' => $cate,
            'modelStudio' => $modelStudio,
            'sid' => $sid,
            'listOcc' => $listOcc,
            'arrDiff' => $arrDiff,
            'add' => $add,
        ]);
    }

    /**
     * Finds the TblStudio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblStudio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblStudio::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
