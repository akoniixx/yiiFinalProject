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
        $locations = new Locations();

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
        ]);
        //return $this->render('index');
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
                    $profile->save();
                    $transaction->commit();
                        if (Yii::$app->getUser()->login($user)) {
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
