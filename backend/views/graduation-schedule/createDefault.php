<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GraduationSchedule */

$this->title = 'Create Graduation Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Graduation Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="graduation-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
