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

    <?= $form->field($model, 'searchStudio') ?>

    <?php //$form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'lineID') ?>

    <?php // echo $form->field($model, 'placeOfWork') ?>

    <?php // echo $form->field($model, 'workType') ?>

    <?php // echo $form->field($model, 'coverImg') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
