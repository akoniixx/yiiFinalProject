<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TblStudio */

$this->title = $model->studioName;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Studios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-studio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cate' => $cate,
        'occupation' => $occupation,
        'myProfile' => $myProfile,
    ]) ?>

</div>
