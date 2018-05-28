<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TblAlbum */

$this->title = 'Create Tbl Album';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Albums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-album-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
