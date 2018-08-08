<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Transfer;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TransferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลการโอนเงิน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transfer-index">

    <h2 style="font-family: 'Prompt', sans-serif;"><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    return $model->transferList->name;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'bank_from',
                'value' => function ($model) {
                    return $model->transferList->bank_from;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'bank_to',
                'value' => function ($model) {
                    return $model->transferList->bank_to;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'transfer_time',
                'value' => function ($model) {
                    return $model->transferList->transfer_time;
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    $status = $model->status;
                    if ($status == Transfer::STATUS_WAIT) {
                        return '<span style="color:orange">รอการตรวจสอบ</span>';
                    } else if ($status == Transfer::STATUS_ACTIVE) {
                        return '<span style="color:green">ตรวจสอบเสร็จสิ้น</span>';
                    } else {
                        return '<span style="color:red">การโอนล้มเหลว</span>';
                    }
                },
                'format' => 'raw'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
