<?php
namespace common\components;

//use common\models\Auth;
use common\models\User;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;
use common\models\UProfile;

/**
* 
*/
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        $attributes = $this->client->getUserAttributes();
        $email = ArrayHelper::getValue($attributes, 'email');
        $id = ArrayHelper::getValue($attributes, 'id');
        $fullName = ArrayHelper::getValue($attributes, 'name');
        $link = ArrayHelper::getValue($attributes, 'link');
        $user = User::findOne(['email' => $email]); 

        if (Yii::$app->user->isGuest && !$user) {
            
            if ($email !== null && User::find()->where(['email' => $email])->exists()) {
                Yii::$app->getSession()->setFlash('error', [
                    Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $this->client->getTitle()]),
                ]);
            } else {
                $password = Yii::$app->security->generateRandomString(6);
                $nickname = explode("@", $email);
                $user = new User([
                    'username' => $nickname[0],
                    'email' => $email,
                    'password' => $password,
                ]);
                $user->generateAuthKey();
                $user->generatePasswordResetToken();

                $transaction = User::getDb()->beginTransaction();

                if ($user->save()) {
                    $name = explode(" ", $fullName);
                    $imageProfile = 'https://graph.facebook.com/'.$id.'/picture?type=large';
                    $uProfile = new UProfile([
                        'id' => $user->id,
                        'firstName' => $name[0],
                        'lastName' => $name[1],
                        'userType' => 'FB',
                        'u_id' => $user->id,
                        'email' => $email,
                        'imgProfile' => $imageProfile,
                    ]);

                    if ($uProfile->save()) {
                        $transaction->commit();
                        Yii::$app->getUser()->login($user);
                        
                    } else {
                        Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', 'Unable to save {client} account: {errors}', [
                                'client' => $this->client->getTitle(),
                                'errors' => json_encode($uProfile->getErrors()),
                            ]),
                        ]);
                    }
                } else {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', 'Unable to save user: {errors}', [
                            'client' => $this->client->getTitle(),
                            'errors' => json_encode($user->getErrors()),
                        ]),
                    ]);
                }
            }
            
        } else { // user already logged in

            if($user->status != User::STATUS_ACTIVE){
                $user->status = User::STATUS_ACTIVE;
                $user->save();
            }
            $profile = UProfile::find()->where(['u_id' => $user->id])->one();

            if(!$profile){
                $name = explode(" ", $fullName);

                $pf = new UProfile();
                $pf->firstname = $name[0];
                $pf->lastname = $name[1];
                $pf->save();
            }

            Yii::$app->getUser()->login($user);
        }
    }

    /**
     * @param User $user
     */
    private function updateUserInfo(User $user)
    {
        $attributes = $this->client->getUserAttributes();
        $github = ArrayHelper::getValue($attributes, 'login');
        if ($user->github === null && $github) {
            $user->github = $github;
            $user->save();
        }
    }

    public function goHome()
    {
        return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
    }
}