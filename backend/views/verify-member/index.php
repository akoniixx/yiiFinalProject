<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\TblStudio;
use common\models\VerifyMember;
use common\models\VerifyStatus;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\VerifyMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Verify Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verify-member-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'verify_id',
            //'img_idCard',
            [
            'options'=>['style'=>'width:150px;'],
            'format'=>'raw',
            'attribute'=>'img_idCard',
            'value'=>function($model){
              $path = '/yii2-project/frontend/web/uploads/verify/'.$model->img_idCard;
              $fullPath = Url::to($path);
              return Html::tag('div','',[
                'style'=>'width:150px;height:95px;
                          border-top: 10px solid rgba(255, 255, 255, .46);
                          background-image:url('.$fullPath.');
                          background-size: cover;
                          background-position:center center;
                          background-repeat:no-repeat;
                          ']);
                }
            ],
            //'img_profile',
            [
            'options'=>['style'=>'width:150px;'],
            'format'=>'raw',
            'attribute'=>'img_profile',
            'value'=>function($model){
              $path = '/yii2-project/frontend/web/uploads/verify/'.$model->img_profile;
              $fullPath = Url::to($path);
              return Html::tag('div','',[
                'style'=>'width:150px;height:95px;
                          border-top: 10px solid rgba(255, 255, 255, .46);
                          background-image:url('.$fullPath.');
                          background-size: cover;
                          background-position:center center;
                          background-repeat:no-repeat;
                          ']);
                }
            ],
            'fname',
            'lname',
            //'tel',
            'studio_id',
            //'created_at',
            [
              'attribute' => 'status',
              'headerOptions' => [
                'style' => 'color:#3c8dbc'
              ],
              'value' => 'verifyStatus.status_name',
              'filter' => Html::activeDropDownList($searchModel, 'verify_status',
                ArrayHelper::map(VerifyStatus::find()->asArray()->all(), 'status_id', 'status_name'),
                //array([2 => 'wait', 1 => 'test', 40 => 'confrim']),
                [
                  'class' => 'from-control', 'prompt' => '-- เลือกสถานะ --'
                ]),
              'contentOptions' => function ($model, $key, $index, $column) {
                  return ['style' => 'color:' 
                      . ($model->verify_status == VerifyMember::CONFIRM ? 'green' : '#ff8f18')];
              },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>' {view} {delete} {ok} ',
                'options'=> ['style'=>'width:120px;'],
                'buttons'=>[
                    'delete' => function($url,$model) {
                        return Html::a('<i class="glyphicon glyphicon-trash"></i>',
                            ['delete', 'id' => $model->verify_id],
                            [
                                'class'=>'btn btn-default',
                                'data' => [
                                    'confirm' => 'กดยืนยันเพื่อลบ',
                                    'method' => 'post',
                                ],
                            ]);
                    },
                    'ok' => function($url,$model,$key){
                        $vid = VerifyMember::findOne($model->verify_id);
                        $sid = $vid->studioValidation;
                        return $sid->confirmation == Confimation::VERIFY ? Html::a('<i class="glyphicon glyphicon-ok" style="color:green;"></i>',false,['class'=>'btn btn-default']) : NULL;
                      }
                ]
            ],
        ],
    ]); ?>

</div>
