<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Reservations;

/* @var $this yii\web\View */
/* @var $model common\models\Reservations */

$this->title = 'ข้อมูลการจองของ '. $model->reservationDetail->name;
$this->params['breadcrumbs'][] = ['label' => 'Reservations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-view">

    <h2 style="font-family: 'Prompt', sans-serif;"><?= Html::encode($this->title) ?></h2>

    <p>
        <?php /*Html::a(Yii::t('common', 'Confirm'), ['confirm', 'id' => $model->id], [
            'class' => 'btn btn-primary',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to confirm this item?'),
                'method' => 'post',
            ],
        ])*/ ?>
        <?php /*Html::a(Yii::t('common', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template'=>'<tr><th>{label}</th><td><i class="glyphicon glyphicon-info-sign"></i></i> {value}</td></tr>',
        'attributes' => [
            [
                'attribute' => 'name',
                'value' => $modelDetail->name,
            ],
            [
                'attribute' => 'tel',
                'value' => $modelDetail->tel,
            ],
            'studio_id',
            [
                'attribute' => 'work',
                'value' => $modelDetail->occupation->TH_name,
            ],
            [
                'attribute' => 'work_detail',
                'value' => $modelDetail->workType->name_type_TH,
            ],
            [
                'attribute' => 'reservation_date',
                'value' => $modelDetail->reservation_date,
            ],
            [
                'attribute' => 'type',
                'value' => function ($model) {
                    if( $model->reservationDetail->type == 1) {
                        // return $newStatus->statusWork(1);
                        return 'ครึ่งวัน';
                    } else {
                        return 'เต็มวัน';
                    }
                }
            ],
            [
                'attribute' => 'contact',
                'value' => $modelDetail->contact,
            ],
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if ($model->status == Reservations::CONFIRM) {
                        return Yii::t('common', 'Confirm');
                    } else {
                        return Yii::t('common', 'Pending');
                    }
                },
            ]
        ],
    ]) ?>

</div>
