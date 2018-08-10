<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\ReservationDetail;
use yii\widgets\Pjax;
use common\models\Reservations;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common', 'Reservations Table');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div style="text-align: right; color: red">
        * สถานะ <p style="font-weight: bold; display: inline;"> จองล้มเหลว </p>
        หมายถึงคุณไม่ได้คิวงาน อาจเกิดจากช่างภาพหรือช่างแต่งหน้าไม่ว่างในวันที่คุณเลือก
        <!-- <p style="display: inline;">rewrss</p> -->
    </div>
    
    <div class="table-responsive">
        <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'rowOptions' => function($model, $key, $index, $column){
                    if($model->status == Reservations::CONFIRM){
                        return ['class' => 'info'];
                    } else if ($model->status == Reservations::DELETE) {
                        return ['class' => 'danger'];
                    }
                },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label' => 'Studio Name',
                        'attribute' => 'studio_id',
                        'value' => function ($model) {
                            return $model->studioDetail->studioName;
                        }
                    ],
                    [
                        'label' => 'Tel',
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->studioDetail->tel;
                        }
                    ],
                    [
                        'label' => 'Work',
                        'attribute' => 'id',
                        'value' => function ($model) {
                            return $model->reservationDetail->occupation->TH_name;
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
                        'attribute' => 'reservation_date',
                        'value' => function ($model) {
                            return $model->reservationDetail->reservation_date;
                        },
                        'filter' => DatePicker::widget([
                            'name' => 'reservation_date',
                            'model' => $searchModel,
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd',
                                'todayHighlight' => true,
                                'eventBackgroundColor' => 'red',
                            ]
                        ]),
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
                        'label' => 'Status',
                        'attribute' => 'status',
                        'value' => function ($model) {
                            if ($model->status == Reservations::CONFIRM) {
                                return 'จองสำเร็จ';
                            } else if ($model->status == Reservations::DELETE) {
                                return 'จองล้มเหลว';
                            }
                            return 'รอการตวจสอบ';
                        },
                        'filter' => Html::activeDropDownList($searchModel, 'status', $arrayModel->arrayStatus(),
                        [
                          'class' => 'from-control', 'prompt' => '-- เลือกสถานะ --',
                          'style' => 'min-height:34px'
                        ]),
                        // 'contentOptions' => function ($model, $key, $index, $column) {
                        //   return ['style' => 'color:' 
                        //       . ($model->verify_status == VerifyMember::CONFIRM ? 'green' : '#ff8f18')];
                        // },
                    ],


                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
