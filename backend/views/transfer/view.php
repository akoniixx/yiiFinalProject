<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Transfer */
$this->registerJsFile("//code.jquery.com/jquery-3.3.1.min.js");
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css");
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js");

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('common', 'Confirm'), ['confirm', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to confirm this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
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
            // 'id',
            // 'user_id',
            // 'status',
            // 'created_at',
            // 'updated_at',
            'user_id',
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return $model->transferList->name;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'tel',
                'value' => function ($model) {
                    return $model->transferList->tel;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'reservation_date',
                'value' => function ($model) {
                    return $model->transferList->reservation_date;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'bank_from',
                'value' => function ($model) {
                    return $model->transferList->bank_from;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'bank_to',
                'value' => function ($model) {
                    return $model->transferList->bank_to;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'bank_id',
                'value' => function ($model) {
                    return $model->transferList->bank_id;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'amount',
                'value' => function ($model) {
                    return $model->transferList->amount;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'slip_image',
                'value' => function ($model) {
                    // return $model->transferList->slip_image;
                    $path = '/yii2-project/frontend/web/uploads/transfer_slip/'.$model->transferList->slip_image;
                    return '<a href="'. $path .'"  data-fancybox="images">'.
                                '<img src="'. $path .'" alt="" style="height:200px;"/>
                            </a>';
                },
                'format' => 'raw',
            ],

        ],
    ]) ?>

</div>
