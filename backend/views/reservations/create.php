<?php

use yii\helpers\Html;
// use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\Reservations */

$this->title = Yii::t('common', 'Create Reservations');
$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-create">

    <h3 class="header-content" style="padding-left: 15px"><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'modelDetail' => $modelDetail,
        'findOccupation' => $findOccupation,
        'findWorkType' => $findWorkType,
        'currentDate' => $currentDate,
        'userModel' => $userModel,
    ]) ?>

</div>
