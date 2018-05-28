<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


                <div class="form-group">
                    <?= yii\authclient\widgets\AuthChoice::widget([
                         'baseAuthUrl' => ['site/auth'],
                         'options' => [
                            'class' => 'auth-client-holder'
                         ]
                    ]) ?>
                </div>

            <?php ActiveForm::end(); ?>
           
        </div>
    </div>
</div>
