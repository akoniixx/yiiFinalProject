<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\ReservationDetail;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (!isset($calendar)) { ?>
        <p>
            <?= Html::a('Create Reservations', ['create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Calendar', ['work-schedule', 'id' => $id], ['class' => 'btn btn-info']) ?>
        </p>
    <?php } ?>

    <div class="table-responsive">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions' => function($model, $key, $index, $column){
                    if($index % 2 == 0){
                        return ['class' => 'info'];
                    }
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    // 'user_id',
                    // 'studio_id',
                    // 'created_at',
                    [
                        'label' => 'Name',
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->name;
                        }
                    ],
                    [
                        'label' => 'Tel',
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->tel;
                        }
                    ],
                    [
                        'label' => 'Work',
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->work;
                        }
                    ],
                    [
                        'label' => 'Work Detail',
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->workType->name_type_TH;
                        }
                    ],
                    [
                        'label' => 'Date',
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->reservation_date;
                        }
                    ],
                    [
                        'label' => 'Type',
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
                    [
                        'label' => 'Contact',
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->contact;
                        }
                    ],


                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
