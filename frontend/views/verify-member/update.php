<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\VerifyMember */

$this->title = 'Update Verify Member: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Verify Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->verify_id, 'url' => ['view', 'id' => $model->verify_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="verify-member-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
