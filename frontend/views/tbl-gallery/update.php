<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TblGallery */

$this->title = 'Update Tbl Gallery: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gID, 'url' => ['view', 'id' => $model->gID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-gallery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
