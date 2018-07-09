<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TblStudio */

$this->title = Yii::t('user', 'Create Tbl Studio');
$this->params['breadcrumbs'][] = ['label' => 'Tbl Studios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-studio-create">

    <h3 class="h3-style"><span class="glyphicon glyphicon-plus" ></span><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'profile' => $profile,
        'item' => $item,
        'cate' => $cate,
        'occupation' => $occupation,
        'myProfile' => $myProfile,
    ]) ?>

</div>
