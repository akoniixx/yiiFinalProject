<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TblGallerySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-gallery-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gID') ?>

    <?= $form->field($model, 'aID') ?>

    <?= $form->field($model, 'gName') ?>

    <?= $form->field($model, 'gimages') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
