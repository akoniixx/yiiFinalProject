<?php

use yii\helpers\Html;
// use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Reservations */

$this->title = 'Create Reservations';
$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetail' => $modelDetail,
        'findOccupation' => $findOccupation,
        'findWorkType' => $findWorkType,
    ]) ?>

</div>
