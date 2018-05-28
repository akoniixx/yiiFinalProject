<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TblAlbum */

$this->title = 'Update Tbl Album: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->albumID, 'url' => ['view', 'id' => $model->albumID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-album-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
