<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UProfile */

$this->title = 'Update Uprofile: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Uprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="uprofile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
