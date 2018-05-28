<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TblStudio */

//$this->title = $model->id;
$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Studios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-studio-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'userID',
            'url:url',
            'studioName',
            //'email:email',
            'tel',
            'lineID',
            //'placeOfWork:ntext',
            //'workType',
            //'coverImg',
            [
                'attribute' => Yii::t('user', 'User ID'),
                'value' => function ($model) {
                    return $model->userProfile->id;
                },
            ],
            [
                'attribute' => Yii::t('user', 'Name'),
                'value' => function ($model) {
                    return $model->userProfile->firstName . " " . $model->userProfile->lastName;
                },
            ],
            [
                'attribute' => Yii::t('user', 'Tel'),
                'value' => function ($model) {
                    return $model->userProfile->tel;
                },
            ],
            [
                'attribute' => Yii::t('user', 'email'),
                'value' => function ($model) {
                    return $model->userProfile->email;
                },
            ],
        ],
    ]) ?>

</div>
