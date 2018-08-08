<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TblStudioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-studio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'id') ?>

    <?php //$form->field($model, 'userID') ?>

    <?php //$form->field($model, 'url') ?>

    <?= $form->field($model, 'searchStudio')->label('ค้นหา') ?>

    <?php //$form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'lineID') ?>

    <?php // echo $form->field($model, 'placeOfWork') ?>

    <?php // echo $form->field($model, 'workType') ?>

    <?php // echo $form->field($model, 'coverImg') ?>

    <div class="form-group">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('รีเซ็ต', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
