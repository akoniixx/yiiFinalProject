<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\components\AuthHandler;
use common\models\UProfile;
use yii\base\Model;
use common\models\TblStudio;
use common\models\TblStudioSearch;
use yii\data\ActiveDataProvider;
use common\models\Occupation;
use common\models\Locations;
use common\models\WorkType;
use common\models\TblCategories;
use yii\helpers\Json;
use common\models\GraduationScheduleSearch;
use common\models\GraduationSchedule;
use common\models\Reservations;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess']
            ],
        ];
    }

    public function actionTestlogin()
    {
        return $this->render('testlogin');
    }

    public function onAuthSuccess($client) {
        (new AuthHandler($client))->handle();
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        /*$posts = TblStudio::find()->limit(10)->all();
        $data = ArrayHelper::toArray($posts, [
            'app\models\Post' => [
                'id',
                'title',
                // the key name in array result => property name
                'createTime' => 'created_at',
                // the key name in array result => anonymous function
                'length' => function ($post) {
                    return strlen($post->content);
                },
            ],
        ]);*/
        $occupation = new Occupation();
        $workHours = $occupation->getWorkHours();
        $model = new TblStudio();
        $searchModel = new TblStudioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $photographer = TblCategories::find()->where(['cateWork' => TblCategories::PHOTOGRAPHER]);
        $dataProviderPhotographer = new ActiveDataProvider([
                'query' => $photographer,
                'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
                'pagination' => [ 'pageSize' => 8 ]
            ]);

        $makeup = TblCategories::find()->where(['cateWork' => TblCategories::MAKEUP_ARTICT]);
        $dataProviderMakeup = new ActiveDataProvider([
                'query' => $makeup,
                'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
                'pagination' => [ 'pageSize' => 8 ]
            ]);

        $dress = TblCategories::find()->where(['cateWork' => TblCategories::DRESS_RENTAL]);
        $dataProviderDress = new ActiveDataProvider([
                'query' => $dress,
                'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
                'pagination' => [ 'pageSize' => 4 ]
            ]);

        // $dataProvider->pagination->pageSize = 5;
        $locations = new Locations();
        $workType = new WorkType();
        // $graduationSchedule = new GraduationScheduleSearch();
        // $dataProviderSchedule = $graduationSchedule->search(Yii::$app->request->queryParams);
        $graduationSchedule = GraduationSchedule::find();
        $dataProviderSchedule = new ActiveDataProvider([
                'query' => $graduationSchedule,
                'sort'=> ['defaultOrder' => ['id'=> SORT_DESC]],
                'pagination' => [ 'pageSize' => 5 ]
            ]);

        if ($searchModel->load(Yii::$app->request->post())) {
            $s = $searchModel->search(Yii::$app->request->queryParams);
            $ss = Yii::$app->user->identity->findIdentity(2);
            return $ss->username;
            /////####$this->render('_search', ['model' => $searchModel]);
        }
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'occupation' => $occupation,
            'workHours' => $workHours,
            'locations' => $locations,
            'workType' => $workType,
            'graduationSchedule' => $graduationSchedule,
            'dataProviderSchedule' => $dataProviderSchedule,
            'dataProviderMakeup' => $dataProviderMakeup,
            'dataProviderDress' => $dataProviderDress,
            'dataProviderPhotographer' => $dataProviderPhotographer,
        ]);
        //return $this->render('index');
    }

    public function actionSearch()
    {
        //$modelStudio = new TblStudio();
        $occupation = new Occupation();
        $text = Yii::$app->request->post('text-search');
        // return $text;
        $post = Yii::$app->request->post();
        //$oc = $occupation->load(Yii::$app->request->post());
        Yii::info($text);

        $postOccupation = $post['Occupation'];
        $postLocations = $post['Locations'];
        $postWorkType = $post['WorkType'];

        $budget = $postOccupation['budget'];
        $locations = $postLocations['location_id'];
        $workType = $postWorkType['id'];
        $occupationId = $postOccupation['id'];
        $workHours = $postOccupation['workHours'];
        $resultTextSearch = [];
        $resultText = "";

        $queryOccupation = Occupation::find()->where(['initials' => $occupationId])->one();
        // return $queryOccupation->TH_name;

        $arrayLocation = array();
        $studioValue = array();

        if (!empty($postLocations)) {
            $queryLocations = Locations::find();
            foreach ($postLocations as $key => $value) {
                $newLocations = new Locations();
                $arrayLocation[] = $value;
                //$queryLocations->orWhere(['like', 'location_name', $value]);
            }
            //echo $queryLocations;
        }

        if (!empty($text) && isset($text) && $text != 'blank') {

            $resultTextSearch[] = $text;
            $itemQuery = TblStudio::find()
                    ->leftJoin(
                        'tbl_categories',
                        'tbl_categories.s_id = tbl_studio.id'
                    )
                    ->Where(['like', 'studioName', $text]);
                    // ->andWhere([
                    //     '=', 'tbl_studio.confirmation', 1
                    // ]);

            if (empty($itemQuery)) {
                echo Yii::t('search', 'Search Empty');
                return true;
            }
            // } else {
            //     foreach ($modelStudio as $key => $value) {
            //         $test = new TblStudio();
            //         $test->studioName = $value['studioName'];
            //         $studioValue[] = $test->studioName;
            //         //echo $test->studioName;
            //     }

            //     echo print_r($studioValue);
            // } 

            // if (empty($arrayLocation)) {
            //     echo "NULL";
            // } else {
            //     print_r($arrayLocation);
            // }
            // echo "<br>";
            //echo print_r($modelStudio);
            
            /*echo $text . "<br>" . $budget . "<br>" . print_r($arrayLocation);
            echo "<br>";
            echo $queryOccupation->TH_name;
*/

            if (!empty($queryOccupation)) {
                //echo $queryOccupation->TH_name;
                $itemQuery->andWhere(['like', 'tbl_categories.cateWork', $queryOccupation->initials]);
                $resultTextSearch[] = $queryOccupation->TH_name;
            }

            if (!empty($workType)) {
                $work_type = WorkType::find()->where(['id' => $workType])->one();
                $itemQuery->andWhere(['like', 'tbl_categories.workDetails', $work_type->name_type]);
                $resultTextSearch[] = $work_type->name_type_TH;
            }

            if (!empty($budget)) {
                
            }

            if (!empty($locations)) {

                foreach ($locations as $value) {
                    $arrayLocation[] = $value;
                }
                $arrayLocationName = array();
                $locationModel = Locations::find()->where(['location_id' => $arrayLocation])->all();
                
                foreach ($locationModel as $key => $value) {
                    $locationName = new Locations();
                    $locationName->location_name = $value['location_name'];
                    $arrayLocationName[] = $locationName->location_name;
                }

                $itemQuery->andWhere(['like', 'tbl_categories.placeOfWork', $arrayLocationName]);
                // $resultTextSearch[] = $arrayLocationName;
            }

            $dataProvider =  new ActiveDataProvider([
                'query' => $itemQuery->orderBy('id DESC'),
                'pagination' => ['pageSize' => 20],
            ]);

            foreach ($resultTextSearch as $key => $value) {
                $resultText .= $value;
            }

            return $this->render('studio-search', [
                'dataProvider' => $dataProvider,
                'resultTextSearch' => $resultTextSearch,
                'resultText' => $resultText,
            ]);
        
        } else {

            $itemQuery = TblStudio::find()
                    ->leftJoin(
                        'tbl_categories',
                        'tbl_categories.s_id = tbl_studio.id'
                    )
                    /*->where([
                        '=', 'tbl_studio.confirmation', 40
                    ])*/;

            if (!empty($queryOccupation)) {
                //echo $queryOccupation->TH_name;
                $itemQuery->andWhere(['like', 'tbl_categories.cateWork', $queryOccupation->initials]);
                $resultTextSearch[] = $queryOccupation->TH_name;
            }

            if (!empty($workType)) {
                $work_type = WorkType::find()->where(['id' => $workType])->one();
                $itemQuery->andWhere(['like', 'tbl_categories.workDetails', $work_type->name_type]);
                $resultTextSearch[] = $work_type->name_type_TH;
            }

            if (!empty($budget)) {
                // echo $budget;
                // $checkBudget = TblCategories::
                // $jsonWorkType = 

                // $itemQuery->andWhere(['and',
                //     ['<=', 'tbl_categories.workDetails', $budget],
                //     ['like', 'tbl_categories.workDetails', $work_type->name_type.'","'.$budget]
                // ]);

                // $arrayWork = Jon::decode()

                // $itemQuery->andWhere(['<=', 'tbl_categories.workDetails', $budget])
                //         ->andWhere(['like', 'tbl_categories.workDetails', $work_type->name_type.'","'.$budget]);
            }

            if (!empty($locations)) {
                //$queryLocations = Locations::find();
                foreach ($locations as $value) {
                    $arrayLocation[] = $value;
                }
                $arrayLocationName = array();
                $locationModel = Locations::find()->where(['location_id' => $arrayLocation])->all();
                
                foreach ($locationModel as $key => $value) {
                    $locationName = new Locations();
                    $locationName->location_name = $value['location_name'];
                    $arrayLocationName[] = $locationName->location_name;
                }

                $itemQuery->andWhere(['like', 'tbl_categories.placeOfWork', $arrayLocationName]);
                // $resultTextSearch[] = $arrayLocationName;
            }
            
            foreach ($resultTextSearch as $key => $value) {
                $resultText .= $value . ", ";
            }

            $dataProvider =  new ActiveDataProvider([
                'query' => $itemQuery->orderBy('active DESC'),
                'pagination' => ['pageSize' => 20],
            ]);

            return $this->render('studio-search', [
                'dataProvider' => $dataProvider,
                'resultTextSearch' => $resultTextSearch,
                'resultText' => $resultText,
            ]);
        }

        
        
        /*return $this->render('search', [
            'text' => $text,
            'oc' => $oc,
        ]);*/
    }

    public function actionOriginalindex()
    {
        return $this->render('originalindex');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        $profile = new UProfile();

        if ($model->load(Yii::$app->request->post()) && 
            $profile->load(Yii::$app->request->post()) &&
            \yii\widgets\ActiveForm::validateMultiple([$profile,$model])) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
            
                if ($user = $model->signup()) {
                    /*if (Yii::$app->getUser()->login($user)) {
                        return $this->goHome();
                    }*/
                    //if($model->save()){
                        //$profile->link('user',$model); // easy way saving relations
                    $profile->u_id = $user->id;
                    $profile->email = $user->email;
                    $profile->imgProfile = 'profile-default-icon.png';
                    $profile->save();

                    Yii::$app->mailer->compose(['html' => 'signupConfirm-html', 'text' => 'signupConfirm-text'], ['user' => $user]) //สามารพเลือกเฉพาะ html หรือ text ในการส่ง
                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ''])
                    ->setTo($user->email)
                    ->setSubject('ยืนยันผู้ใช้งาน ' . \Yii::$app->name)
                    ->send();

                    // return $this->goHome();

                    $transaction->commit();
                        if (Yii::$app->getUser()->login($user)) {
                            Yii::$app->session->setFlash('success', 'สมัครสมาชิกเรียบร้อย กรุณาตรวจสอบอีเมลล์เพื่อยืนยันการใช้งานอีกครั้ง');
                            return $this->goHome();
                        }
                        
                    //}
                }
                    //return "true";
            } catch (\Exception $e) {
                $transaction->rollBack();
                return $e;
            }
        }

        return $this->render('signup', [
            'model' => $model,
            'profile' => $profile,
        ]);
    }

    public function actionSignupConfirm($auth_key)
    {
        
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
