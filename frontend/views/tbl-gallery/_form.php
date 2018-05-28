<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TblGallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-gallery-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aID')->textInput() ?>

    <?= $form->field($model, 'gName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gimages')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
