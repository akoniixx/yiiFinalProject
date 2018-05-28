<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TblStudio */

$this->title = 'Create Tbl Studio';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Studios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-studio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'profile' => $profile,
        'item' => $item,
        'cate' => $cate,
        'occupation' => $occupation,
    ]) ?>

</div>
