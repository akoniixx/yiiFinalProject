<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Userdb */
/* @var $form yii\widgets\ActiveForm */
/*'id' => 'ID',
            'password' => 'รหัสผ่าน',
            'password_repeat' => 'ยืนยันรหัสผ่าน',
            'firstName' => 'ชื่อ',
            'lastName' => 'นามสกุล',
            'email' => 'อีเมล',
            'tel' => 'เบอร์โทรศัพท์',
            'usreType' => 'Usre Type',
            'imgProfile' => 'Img Profile',*/

?>

<div class="userdb-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'imgProfile')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
