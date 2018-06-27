<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\GraduationSchedule;
use yii\widgets\ActiveForm;
use lavrentiev\widgets\toastr\Notification;
use common\models\WorkSchedule;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GraduationScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('schedule', 'Graduation Schedule');
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .btn-xs {
        width: 100%;
    }
    .table > tbody > tr > td {
        vertical-align: middle;
    }
</style>
<div class="graduation-schedule-index">

    <h3 class="h3-style"><span class="glyphicon glyphicon-calendar" ></span><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?php $form = ActiveForm::begin(/*['action' => ['graduation-schedule/join-graduate']]*/); ?>

    <div class="table-responsive">
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['style' => 'font-size: 16px;'],
        // 'showFooter'=> false,
        // 'class' => 'table-responsive-sm',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'schedule',
            [
                'attribute' => 'schedule',
                'value' => function ($data) {
                    return $data->university->name;
                },
                'headerOptions' => ['style' => 'text-align: center;vertical-align: inherit;'],
                // 'filter' => ArrayHelper::map(GraduationSchedule::find()->orderBy(['schedule' => SORT_ASC])->all(), 'id', $model->university->name),
                
            ],
            // 'details',
            [
                'attribute' => 'details',
                'value' => function ($data) {
                    return $data->graduationDetails->detail;
                },
                'headerOptions' => ['style' => 'text-align: center;vertical-align: inherit;'],
            ],
            // 'date',
            [
                'label' => 'วันที่',
                'attribute' => 'date',
                'value' => function ($model) {
                return $model->formatGraduationDate($model->date);
                // return $model->date;
                },
                'headerOptions' => ['style' => 'text-align: center;vertical-align: inherit;'],
            ],
            [
                'label' => 'ลงทะเบียนช่างภาพ',
                'headerOptions' => ['style' => 'width:10%;text-align: center;'],
                'contentOptions' => ['style' => 'padding: 15px;'],
                'content' => function($model) use ($studioId) {
                    // return Html::a('ลงทะเบียน', ['site/index'], [
                    //     'class' => 'btn btn-success btn-xs',
                    //     'data-pjax' => 0,
                    //     'value' => $model->id,
                    // ]);
                    // return  Html::submitButton('ลงทะเบียน', [
                    //     'class' => 'btn btn-success btn-xs',
                    //     'name' => 'submit_ph',
                    //     'value' => $model->id,
                    // ]);
                    // $studioId = Yii::$app->studio->getStudioId();
                    $find = WorkSchedule::find()->where(['graduation_id' => $model->id])
                            ->andWhere(['s_id' => $studioId])
                            ->andWhere(['typeOfWork' => 'Ph'])
                            ->one();
                    if (isset($find)) {
                        return Html::a('ลบ', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-xs',
                            'data' => [
                                'confirm' => 'กดยืนยันเพื่อลบ',
                                'method' => 'post',
                            ],
                        ]);
                    } else {
                        return  Html::submitButton('ลงทะเบียน', [
                        'class' => 'btn btn-success btn-xs',
                        'name' => 'submit_ph',
                        'value' => $model->id,
                        ]);
                    }
                    // return print_r($arrWork);
                }
            ],
            [
                'label' => 'ลงทะเบียนช่างแต่งหน้า',
                'headerOptions' => ['style' => 'width:10%;text-align: center;'],
                'contentOptions' => ['style' => 'padding: 15px;'],
                'content' => function($model) use ($studioId) {
                    // return Html::a('ลงทะเบียน', ['site/index'], [
                    //     'class' => 'btn btn-info btn-xs',
                    //     'style' => 'cursor: not-allowed; opacity:0.5',
                    //     'onclick' => 'return false',
                    //     'data-pjax' => 0
                    // ]);
                    // return  Html::submitButton('ลงทะเบียน', [
                    //     'class' => 'btn btn-info btn-xs',
                    //     'name' => 'submit_ma',
                    //     'value' => $model->id,
                    // ]);

                    $find = WorkSchedule::find()->where(['graduation_id' => $model->id])
                            ->andWhere(['s_id' => $studioId])
                            ->andWhere(['typeOfWork' => 'Ma'])
                            ->one();
                    if (isset($find)) {
                        return Html::a('ลบ', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-xs',
                            'data' => [
                                'confirm' => 'กดยืนยันเพื่อลบ',
                                'method' => 'post',
                            ],
                        ]);
                    } else {
                        return  Html::submitButton('ลงทะเบียน', [
                        'class' => 'btn btn-info btn-xs',
                        'name' => 'submit_ma',
                        'value' => $model->id,
                        ]);
                    }

                }
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php /*if (Yii::$app->session->hasFlash('success')) :
        Notification::widget([
            'type' => 'success',
            'message' => Yii::t('norifications', 'เพิ่มข้อมูลเรียบร้อยแล้ว'),
        ]);
    endif;*/ ?>

</div>
