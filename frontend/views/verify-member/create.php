<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\VerifyMember */

$this->title = 'Create Verify Member';
$this->params['breadcrumbs'][] = ['label' => 'Verify Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verify-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
