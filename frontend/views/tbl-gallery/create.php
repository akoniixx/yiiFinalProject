<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TblGallery */

$this->title = 'Create Tbl Gallery';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
