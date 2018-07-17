<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = Yii::t('user', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div style="text-align:center;">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?= Yii::t('user', 'Please fill out the following fields to login') ?>:</p>
    </div>

    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-sm-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    <?= Yii::t('user', 'If you forgot your password you can') ?> <?= Html::a(Yii::t('user', 'reset it'), ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?= yii\authclient\widgets\AuthChoice::widget([
                         'baseAuthUrl' => ['site/auth'],
                         'options' => [
                            'class' => 'auth-client-holder'
                         ],
                         'popupMode' => true,
                         'autoRender' => true,
                    ]) ?>

                </div>

            <?php ActiveForm::end(); ?>
           
        </div>
    </div>
</div>

