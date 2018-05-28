<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Userdb */

$this->title = 'Update Userdb: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Userdbs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="userdb-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
