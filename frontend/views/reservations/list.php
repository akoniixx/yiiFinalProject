<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\ReservationDetail;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตารางงาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (!isset($calendar)) { ?>
        <p>
            <?php /*Html::a('Create Reservations', ['create'], ['class' => 'btn btn-success'])*/ ?>
            <?= Html::a('ปฏิทินงาน', ['work-schedule', 'id' => $id], ['class' => 'btn btn-info']) ?>
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
                        'label' => Yii::t('common', 'User Name'),
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->name;
                        }
                    ],
                    [
                        'label' => Yii::t('common', 'Tel'),
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->tel;
                        }
                    ],
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
                    // [
                    //     'label' => Yii::t('common', 'Contact'),
                    //     'attribute' => 'id',
                    //     'value' => function ($model) {
                    //         return $model->reservationDetail->contact;
                    //     }
                    // ],


                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
