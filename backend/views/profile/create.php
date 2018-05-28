<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UProfile */

$this->title = 'Create Uprofile';
$this->params['breadcrumbs'][] = ['label' => 'Uprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uprofile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
