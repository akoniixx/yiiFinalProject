<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use common\models\ReservationDetail;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตารางการจอง';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-index">

    <h2 style="font-family: 'Prompt', sans-serif;"><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

                'user_id',
                [
                    'label' => Yii::t('common', 'Tel'),
                    'attribute' => 'id',
                    'value' => function ($model) {
                        return $model->reservationDetail->tel;
                    }
                ],
                'studio_id',
                [
                    'label' => Yii::t('common', 'Occupation'),
                    'attribute' => 'id',
                    'value' => function ($model) {
                        return $model->reservationDetail->occupation->TH_name;
                    }
                ],
                [
                    'label' => Yii::t('common', 'Work Detail'),
                    'attribute' => 'id',
                    'value' => function ($model) {
                        return $model->reservationDetail->workType->name_type_TH;
                    }
                ],
                [
                    'label' => Yii::t('common', 'Date Of Work'),
                    'attribute' => 'id',
                    'value' => function ($model) {
                        return $model->reservationDetail->reservation_date;
                    }
                ],
                [
                    'label' => Yii::t('common', 'Type Of Work'),
                    'attribute' => 'id',
                    'value' => function ($model) {
                        $newStatus = new ReservationDetail();
                        if( $model->reservationDetail->type == 1) {
                            // return $newStatus->statusWork(1);
                            return 'ครึ่งวัน';
                        } else {
                            return 'เต็มวัน';
                        }
                    }
                ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
