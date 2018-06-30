<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;
use common\models\WorkSchedule;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GraduationScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Graduation Schedules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="graduation-schedule-index">

    <h3 class="h3-style"><span class="glyphicon glyphicon-calendar" ></span><?= Yii::t('schedule', 'Graduation Schedules') ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="table-responsive">
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['style' => 'font-size: 16px;'],
        // 'layout'=>"\n{pager}\n{items}",
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'date',
            [
              'label' => 'วันที่',
              'attribute' => 'date',
              'value' => function ($model) {
                return $model->formatGraduationDate($model->date);
                // return $model->date;
              },
              'headerOptions' => ['style' => 'width:20%;text-align: center;vertical-align: inherit;'],
              'contentOptions' => ['style' => 'padding: 15px;text-align: center;'],
              'filter' => DatePicker::widget([
                  'name' => 'GraduationScheduleSearch[date]',
                  'attribute' => 'date',
                  // 'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                  // 'value' => time(),
                  'pluginOptions' => [
                      'autoclose'=>true,
                      'format' => 'yyyy-mm-dd',
                      'todayHighlight' => true
                  ]
              ]),
            ],
            // 'schedule' => 'schedule',
            [
              'label' => 'รายชื่อมหาลัย',
              'attribute' => 'schedule',
              'headerOptions' => ['style' => 'text-align: center;vertical-align: inherit;'],
              'contentOptions' => ['style' => 'padding: 15px;'],
              'value' => function ($model) {
                return $model->university->name;
              },
            ],
            [
              'label' => 'รายละเอียด',
              'attribute' => 'details',
              'value' => function ($model) {
                return $model->graduationDetails->detail;
              },
              'headerOptions' => ['style' => 'width:15%;text-align: center;vertical-align: inherit;'],
              'contentOptions' => ['style' => 'padding: 15px;'],
            ],
            
            // ['class' => 'yii\grid\ActionColumn'],
            [
              'label' => 'ช่างภาพที่ว่าง',
              'headerOptions' => ['style' => 'width:10%;text-align: center;'],
              'contentOptions' => ['style' => 'padding: 15px;text-align: center;font-size:16px'],
              'content' => function ($model) {
                $find = WorkSchedule::find()
                      // ->select(['COUNT(*) as cnt'])
                      ->where(['graduation_id' => $model->id])
                      ->andWhere(['typeOfWork' => WorkSchedule::PHOTOGRAPHER])
                      ->groupBy(['id'])
                      ->count();
                // return $find;
                return Html::a($find, ['list', 'id' => $model->id, 'type' => WorkSchedule::PHOTOGRAPHER], [
                    'class' => 'btn btn-success btn-xs',
                    // 'data' => [
                    //     // 'confirm' => 'กดยืนยันเพื่อลบ',
                    //     'method' => 'get',
                    // ],
                ]);
              },
            ],
            [
              'label' => 'ช่างแต่หน้าที่ว่าง',
              'headerOptions' => ['style' => 'width:10%;text-align: center;'],
              'contentOptions' => ['style' => 'padding: 15px;text-align: center;'],
              'content' => function ($model) {
                $find = WorkSchedule::find()
                      // ->select(['COUNT(*) as cnt'])
                      ->where(['graduation_id' => $model->id])
                      ->andWhere(['typeOfWork' => WorkSchedule::MAKEUP_ARTIST])
                      ->groupBy(['id'])
                      ->count();
                // return $find;
                return Html::a($find, ['list', 'id' => $model->id, 'type' => WorkSchedule::MAKEUP_ARTIST], [
                    'class' => 'btn btn-info btn-xs',
                    // 'data' => [
                    //     // 'confirm' => 'กดยืนยันเพื่อลบ',
                    //     'method' => 'get',
                    // ],
                ]);
              },
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>
</div>
