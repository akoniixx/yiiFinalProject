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

?>
<style>
    
footer {
  background-color: #f2f2f2;
  padding: 25px;
}

.boxed-grey {
background: #f9f9f9;
padding: 20px;
background-image: url(https://s3.amazonaws.com/Syntaxxx/background-gold-bokeh.jpg);
border-radius: 15px;
}
.avatar {
    margin-bottom: 20px;
}
.img-responsive {
    display: block;
    max-width: 100%;
    height: 50%;
    width: 50%;
}
.team p.subtitle {
    margin-bottom: 10px;
}
.inner {
	margin-bottom: -15px
}
div#masonry:hover .col-sm-3 { opacity: 0.8; }
div#masonry:hover .col-sm-3:hover { opacity: 1; } 

/* fallback for earlier versions of Firefox */

@supports not (flex-wrap: wrap) {
  div#masonry { display: block; }
  div#masonry img {  
  display: inline-block;
  vertical-align: top;
  }
}
.text-link {
  color: black;
  cursor: pointer;
}
.text-link p {
  font-size: 16px;
}
</style>

</head>
<body>

<div class="container text-center">
  <div class="input-group" id="boot-search-box">
      <input type="text" class="form-control" placeholder="<?= Yii::t('search', 'Search') ?>" />
      <div class="input-group-btn">
          <div class="btn-group" role="group">
              <div class="dropdown dropdown-lg">
                <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <div class="form-group">
                        <label for="filter"> <?= Yii::t('search', 'Manage Search') ?> :</label>
                        <?= $form->field($occupation, 'id')->dropDownList(
                          ArrayHelper::map(Occupation::find()->all(), 'id','TH_name'),
                          [
                            'prompt' => '-- อาชีพ --',
                            //'onchange' => 'checkOccupation();',
                            'required'=> true,
                          ]
                        ); ?>
                      </div>
                      <div class="form-group" id="hide-locations" style="display: none;">
                        <label for="contain">Brand:</label>
                        <?= $form->field($locations, 'location_id')->widget(Select2::classname(), [
                          'data' => ArrayHelper::map(Locations::find()->all(), 'location_id', 'location_name'),
                          'options' => ['placeholder' => Yii::t('search', 'Province'), 'multiple' => true],
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



<div class="container bg-3" id="masonry">    
  <h3>Some of my Work</h3><br>
  <div class="row">
    <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '/site/_fanpagedetail',
            'summary' => false,
            'itemOptions' => [
                'class' => 'col-sm-3',
            ],
            /*'viewParams' => [
                'aName' => $aName,
                'baseUrl' => $baseUrl,
            ],*/
        ]);
    ?>
  </div>
</div><br>

<div class="container-fluid bg-3 text-center">    
  <div class="row">
    <div class="col-sm-3">
      <p>Some text..</p>
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-3"> 
      <p>Some text..</p>
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-3"> 
      <p>Some text..</p>
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-3">
      <p>Some text..</p>
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    </div>
  </div>
</div><br><br>

<?php
  echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'One',
            'content' => 'Anim pariatur cliche...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'Anim pariatur cliche...',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID'],
        ],
    ],
]);
?>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

<?php

$js = <<< JS

$("#occupation-id").on("click", function() {
    
    var current_value = this.value;

    if (current_value == 1) {
        
      document.getElementById("hide-locations").style.display = "block";
      document.getElementById("hide-budget").style.display = "block";
      document.getElementById("hide-work-hours").style.display = "block";

    } else if (current_value == 2) {
        
      document.getElementById("hide-locations").style.display = "block";
      document.getElementById("hide-budget").style.display = "block";
      document.getElementById("hide-work-hours").style.display = "none";

    } else if (current_value == 3) {
        
      document.getElementById("hide-locations").style.display = "block";
      document.getElementById("hide-budget").style.display = "block";
      document.getElementById("hide-work-hours").style.display = "none";

    } else if (current_value == '') {

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