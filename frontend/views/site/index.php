<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Occupation;
use common\models\TblStudioSearch;
use kartik\select2\Select2;
use common\models\Locations;
use common\models\WorkType;
use yii\grid\GridView;
use common\models\WorkSchedule;
use kartik\date\DatePicker;
use yii\widgets\Pjax;

?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<style>
    
footer {
  background-color: #f2f2f2;
  padding: 25px;
}

</style>

</head>
<body>

<div class="container text-center" style="padding-top: inherit;">
  <div class="input-group" id="boot-search-box">
      <input type="text" class="form-control" placeholder="<?= Yii::t('search', 'Search') ?>" onchange="checkText(this.value)"/>
      <div class="input-group-btn">
          <div class="btn-group" role="group">
              <div class="dropdown dropdown-lg">
                <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'action' => ['site/search']]); ?>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <div class="form-group">
                        <label for="filter"> <?= Yii::t('search', 'Manage Search') ?> :</label>
                        <?= $form->field($occupation, 'id')->dropDownList(
                          ArrayHelper::map(Occupation::find()->all(), 'initials','TH_name'),
                          [
                            'prompt' => '-- อาชีพ --',
                            //'onchange' => 'checkOccupation();',
                            //'required'=> true,
                          ]
                        ); ?>
                      </div>
                      <div class="form-group" id="hide-work-type" style="display: none;">

                        <?= $form->field($workType, 'id')->dropDownList(
                          ArrayHelper::map(WorkType::find()->orderBy(['id' => SORT_ASC])->all(), 'id', 'name_type_TH'),
                          [
                            'prompt' => '-- ' . Yii::t('search', 'Type of Work') . ' --',
                          ]
                        ); ?>
                        
                      </div>

                      <div class="form-group" id="hide-locations" style="display: none;">

                        <?= $form->field($locations, 'location_id')->widget(Select2::classname(), [
                          'data' => ArrayHelper::map(Locations::find()->orderBy(['location_name' => SORT_ASC])->all(), 'location_id', 'location_name'),
                          'options' => ['placeholder' => Yii::t('search', 'Province') . '..', 'multiple' => true],
                          'pluginOptions' => [
                              'tags' => true,
                              'tokenSeparators' => [',', ' '],
                              'maximumInputLength' => 10
                            ],
                        ])->label('Tag Multiple'); ?>
                        
                      </div>
                      <div class="form-group" id="hide-budget" style="display: none;">
                        <?= $form->field($occupation, 'budget')->textInput(['type' => 'number', 'step' => 100]) ?>
                      </div>

                      <div class="form-group" id="hide-work-hours" style="display: none;">
                        <?= $form->field($occupation, 'workHours')->dropDownList($workHours); ?>
                      </div>

                      <!-- <p id="text-search" style="display: none;"></p> -->

                      <?= $form->field($model, 'studioName')->textInput([
                        'id' => 'text-search',
                        'name' => 'text-search',
                        'style' => 'display : none',
                        'value' => 'blank',
                      ]) ?>
                      
                     <div class="form-group"><!-- </div> -->
                        
                      <br /><br />                    
                      <?= Html::submitButton(Yii::t('search', 'Search').' :: <span class="glyphicon glyphicon-search" aria-hidden="true">', ['class' => 'btn btn-info btn-block']) ?>
                  </div>
                <!-- end activeform -->
              </div>
              <?php echo Html::submitButton('<span class="glyphicon glyphicon-search" aria-hidden="true"></span>', ['class' => 'btn btn-info']); ?>
              <?php ActiveForm::end(); ?>
          </div>
      </div>
  </div>
</div>
</div>

<!-- <div ng-app="">
 
<p>Name: <input type="text" ng-model="name"></p>
<p>You wrote: {{ name }}</p>

</div> -->

<div class="container bg-3" id="masonry">    
  <h3><?= Yii::t('index', 'Photographer Recommend') ?></h3><hr>
  <div class="row">
    <?=
        ListView::widget([
            'dataProvider' => $dataProviderPhotographer,
            'itemView' => '/site/_fanpagedetail',
            'summary' => false,
            'itemOptions' => [
                'class' => 'col-sm-3',
                'style' => 'padding-bottom: 15px;'
            ],
            /*'viewParams' => [
                'aName' => $aName,
                'baseUrl' => $baseUrl,
            ],*/
        ]);
    ?>
  </div>
</div><br>

<div class="container bg-3" id="masonry">    
  <h3><?= Yii::t('index', 'Makeup-Artist Recommend') ?></h3><hr>
  <div class="row">
    <?=
        ListView::widget([
            'dataProvider' => $dataProviderMakeup,
            'itemView' => '/site/_fanpagedetail',
            'summary' => false,
            'itemOptions' => [
                'class' => 'col-sm-3',
                'style' => 'padding-bottom: 15px;'
            ],
            /*'viewParams' => [
                'aName' => $aName,
                'baseUrl' => $baseUrl,
            ],*/
        ]);
    ?>
  </div>
</div><br>

<div class="container bg-3" id="masonry">    
  <h3><?= Yii::t('index', 'Rental Services Recommend') ?></h3><hr>
  <div class="row">
    <?=
        ListView::widget([
            'dataProvider' => $dataProviderDress,
            'itemView' => '/site/_fanpagedetail',
            'summary' => false,
            'itemOptions' => [
                'class' => 'col-sm-3',
                'style' => 'padding-bottom: 15px;'
            ],
            /*'viewParams' => [
                'aName' => $aName,
                'baseUrl' => $baseUrl,
            ],*/
        ]);
    ?>
  </div>
</div><br>



<?php
//   echo TabsX::widget([
//     'position' => TabsX::POS_ABOVE,
//     'align' => TabsX::ALIGN_LEFT,
//     'items' => [
//         [
//             'label' => 'One',
//             'content' => 'Anim pariatur cliche...',
//             'active' => true
//         ],
//         [
//             'label' => 'Two',
//             'content' => 'Anim pariatur cliche...',
//             'headerOptions' => ['style'=>'font-weight:bold'],
//             'options' => ['id' => 'myveryownID'],
//         ],
//     ],
// ]);
?>


<h3 class="studio-name"><?= Yii::t('index', 'Graduation Schedule') ?></h3>
<div class="table-responsive">
<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProviderSchedule,
    // 'filterModel' => $graduationSchedule,
    'options' => ['style' => 'font-size: 16px;'],
    'layout'=>"\n{items}",
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
              'name' => 'dp_2',
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
            return Html::a($find, ['graduation-schedule/list','id' => $model->id, 'type' => WorkSchedule::PHOTOGRAPHER], [
                'class' => 'btn btn-success btn-xs',
                // 'data' => [
                //     // 'confirm' => 'กดยืนยันเพื่อลบ',
                //     'method' => 'post',
                // ],
            ]);
          },
        ],
        [
          'label' => 'ช่างแต่งหน้าที่ว่าง',
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
            return Html::a($find, ['graduation-schedule/list', 'id' => $model->id, 'type' => WorkSchedule::MAKEUP_ARTIST], [
                'class' => 'btn btn-info btn-xs',
                // 'data' => [
                //     // 'confirm' => 'กดยืนยันเพื่อลบ',
                //     'method' => 'post',
                // ],
            ]);
          },
        ]
    ],
]); ?>
<?php Pjax::end(); ?>
</div>

<div class="form-group text-center" style="padding-top: 10px;">
    <div style="padding-left: 15px; padding-right: 15px;">
        <?php
        // $studioId = Yii::$app->studio->getStudioId();
        if (!Yii::$app->user->isGuest && Yii::$app->studio->getStudioId() != NULL) {
          echo Html::a(Yii::t('index', 'Register Graduation Schedule'),
              ['graduation-schedule/index'],
              ['class' => 'btn btn-info btn-block', 'style' => 'font-size:18px']);
        } else {
            echo Html::a(Yii::t('index', 'View Schedule'),
              ['graduation-schedule/view-all'],
              ['class' => 'btn btn-primary btn-block', 'style' => 'font-size:18px']);
        }
        ?>
    </div>
</div>

<!-- <footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>
 -->
<script>

function checkText(val) {
    //var x = val;
    //document.getElementById("text-search").innerHTML = "You selected: " + x;
    var x = val;
    document.getElementById("text-search").value = x;
}

</script>

<?php

$js = <<< JS

$("#occupation-id").on("click", function() {
    
    var current_value = this.value;

    if (current_value == "Ph") {
        
      document.getElementById("hide-work-type").style.display = "block";
      document.getElementById("hide-locations").style.display = "block";
      document.getElementById("hide-budget").style.display = "block";
      document.getElementById("hide-work-hours").style.display = "block";

    } else if (current_value == "Ma") {
        
      document.getElementById("hide-work-type").style.display = "block";
      document.getElementById("hide-locations").style.display = "block";
      document.getElementById("hide-budget").style.display = "block";
      document.getElementById("hide-work-hours").style.display = "none";

    } else if (current_value == "Dr") {
        
      document.getElementById("hide-work-type").style.display = "none";
      document.getElementById("hide-locations").style.display = "block";
      document.getElementById("hide-budget").style.display = "block";
      document.getElementById("hide-work-hours").style.display = "none";

    } else if (current_value == '') {

      document.getElementById("hide-work-type").style.display = "none";
      document.getElementById("hide-locations").style.display = "none";
      document.getElementById("hide-budget").style.display = "none";
      document.getElementById("hide-work-hours").style.display = "none";

    }

});

JS;
 
// register your javascript
$this->registerJs($js);

?>

</body>
</html>

<!--  $("#occupation-id").change(function(){
   var value = this.value;
   if(value == 1){
   $(".Salutation").val("0");
   }
   if(value == 2){
   $(".Salutation").val("4");
   }
   if(value == 3){
   $(".Salutation").val("23");
} -->