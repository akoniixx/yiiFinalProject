<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('index', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .star {
        color: red;
        font-size: 18px;
    }
    form div.required label.control-label:after {
      content:" * ";
      color:red;
    }
</style>
<div class="site-signup">

    <div style="text-align:center;">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?= Yii::t('user', 'Please fill out the following fields to signup') ?>:</p>
        <br>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-sm-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'layout' => 'horizontal']); ?>

                <?php //$form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                <?= $form->field($profile, 'firstName')->textInput() ?>

                <?= $form->field($profile, 'lastName')->textInput() ?>

                <?= $form->field($profile, 'tel')->textInput(['maxlength' => true]) ?>
                <br>

                <div class="form-group" style="text-align:center;">
                    <div class="col-sm-6 col-lg-4 col-lg-offset-1">
                        <?= Html::submitButton(Yii::t('user', 'Confirm'), ['class' => 'btn btn-primary', 'name' => 'signup-button', 'style' => 'width:50%']) ?>
                    </div>
                    <div class="col-sm-6 col-lg-4 col-lg-offset-2">
                        <?= Html::a(Yii::t('user', 'Cancel'), ['site/index'], ['class' => 'btn btn-default', 'name' => 'cancel-button', 'style' => 'width:50%']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>

            <div class="col-sm-12 col-lg-12" style="margin-top: 15px;">  
                <p style="color: red;">
                    <span class="star">*</span> ข้อมูลทุกอย่างควรเป็นข้อมูลจริงเพื่อใช้ในการยืนยันตัวตน<br>
                </p>
            </div>

        </div>
    </div>
</div>
