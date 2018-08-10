<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use yii\db\Query;
use common\models\Locations;
use kartik\select2\Select2;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\TblStudio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-studio-form" style="padding-top: 20px">

    <?php $form = ActiveForm::begin(/*['layout' => 'horizontal']*/); ?>

    <!-- $form->field($model, 'gimages[]')->fileInput(['multiple' => true]) -->
    <div class="col-xs-12 col-md-6" style="padding-right: 15px; border-right: 1px solid #cac8c8">

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <div class="col-xs-6 col-md-6" style="padding-left: 0px">
    <?= $form->field($cate, 'cateWork')->dropDownList(
        ArrayHelper::map($occupation, 'initials', 'TH_name'),
        ['prompt'=>'กรุณาเลือกอาชีพ'])
    ?>
    </div>

    <div class="col-xs-6 col-md-6" style="padding-right: 0px">
    <?= $form->field($model, 'studioName')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-xs-6 col-md-6" style="padding-left: 0px">
    <?= $form->field($model, 'tel')->textInput(['maxlength' => true, 'value' => $myProfile->tel ? $myProfile->tel : NULL]) ?>
    </div>

    <div class="col-xs-6 col-md-6" style="padding-right: 0px">
    <?= $form->field($model, 'lineID')->textInput(['maxlength' => true]) ?>
    </div>

    <?= $form->field($cate, 'placeOfWork')->widget(Select2::classname(), [
      'data' => ArrayHelper::map(Locations::find()->orderBy(['location_name' => SORT_ASC])->all(), 'location_id', 'location_name'),
      'options' => ['placeholder' => Yii::t('search', 'เลือกจังหวัด') . '..', 'multiple' => true],
      'pluginOptions' => [
          'tags' => true,
          'tokenSeparators' => [',', ' '],
          'maximumInputLength' => 10
        ],
    ])->label('จังหวัดที่รับงาน'); ?>

    </div>

    <div class="col-xs-12 col-md-6" style="padding-left: 15px;">
        
        <div class="col-xs-12 col-md-12" style="padding-left: 0px; padding-right: 0px">
        <?= $form->field($model, 'description')->textarea(['rows' => '8']) ?>
        </div>

        <div class="col-xs-6 col-md-6" style="padding-left: 0px;display:none;" id="location1">
        <?= $form->field($cate, 'workDetails[]')->textInput(['maxlength' => true])->label('ลาติจูด') ?>
        </div>

        <div class="col-xs-6 col-md-6" style="padding-right: 0px;display:none;" id="location2">
        <?= $form->field($cate, 'workDetails[]')->textInput(['maxlength' => true])->label('ลองจิจูด') ?>
        </div>
    </div>

    <?php /*echo $form->field($cate, 'placeOfWork')->widget(MultipleInput::className(), [
        'max'               => 77,
        'min'               => 1, // should be at least 2 rows
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        'addButtonPosition' => MultipleInput::POS_HEADER,
        'columns' => [
        [
            'name' => 'location_name',
            'title' => 'จังหวัดที่รับงาน',
            'type'  => 'dropDownList',
            'items' => ArrayHelper::map(Locations::find()->orderBy(['location_name' => SORT_ASC])->all(), 'location_name', function($item){return $item->location_name;}),
            'enableError' => true,
            'options' => [
                'prompt' => 'เลือกจังหวัด',
                //'onchange' => '$(this).init_change();' //ส่งค่าไปเรียก Ajax
            ]
        ]
        ], // show add button in the header
    ])->label(false);*/ ?>
    <div class="col-xs-12 col-md-12">
    <h2>ประเภทงานที่รับและราคา</h2>
    
    <div class="border-price-div" id="hide-elements">
        <div class="inline form-inline" style="border-radius: 15px;">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'congratulation'])->label(false); ?>          
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn1.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">รับปริญญา</label>
            <div class="input-price">
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาครึ่งวัน', ['class' => 'control-label col-sm-6']) ?>
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาเต็มวัน', ['class' => 'control-label col-sm-6']) ?>
            </div>
        </div>
        
        <div class="inline form-inline">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'fashion'])->label(false); ?>    
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn2.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">ภาพบุคคล/แฟชั่น</label>
            <div class="input-price">
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาครึ่งวัน', ['class' => 'control-label col-sm-6']) ?>
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาเต็มวัน', ['class' => 'control-label col-sm-6']) ?>
            </div>
        </div>

        <div class="inline form-inline">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'wedding'])->label(false); ?>    
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn3.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">งานแต่ง</label>
            <!-- <input type="hidden" name="quantity[]" value="-">
            <input type="hidden" name="quantity[]" value="-"> -->
        </div>

        <div class="inline form-inline">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'pre-wedding'])->label(false); ?>    
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn4.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">พรีเวดดิ้ง</label>
            <!-- <input type="hidden" name="quantity[]" value="-">
            <input type="hidden" name="quantity[]" value="-"> -->
        </div>

        <div class="inline form-inline">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'event'])->label(false); ?>    
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn5.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">งานอีเวนต์</label>
            <div class="input-price">
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาครึ่งวัน', ['class' => 'control-label col-sm-6']) ?>
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาเต็มวัน', ['class' => 'control-label col-sm-6']) ?>
            </div>
        </div>

        <div class="inline form-inline" id="this-hide1">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'architecture'])->label(false); ?>    
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn6.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">สถาปัตยกรรม</label>
            <div class="input-price">
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาครึ่งวัน', ['class' => 'control-label col-sm-6']) ?>
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาเต็มวัน', ['class' => 'control-label col-sm-6']) ?>
            </div>
        </div>

        <div class="inline form-inline" id="this-hide2">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'productAndFood'])->label(false); ?>    
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn7.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">สินค้า/อาหาร</label>
            <!-- <input type="hidden" name="quantity[]" value="-">
            <input type="hidden" name="quantity[]" value="-"> -->
        </div>
    </div>
    

    <div id="map" style="width:100%;height:400px;display:none;"></div>

    <div class="form-group text-center" style="padding-top: 50px;">
        <div style="padding-left: 15px; padding-right: 15px;">
            <?= Html::submitButton('ยืนยืน', ['class' => 'btn btn-primary', 'style' => 'width:35%']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- <script>
    function myMap() {
      var mapCanvas = document.getElementById("map");
      var mapOptions = {
        center: new google.maps.LatLng(13.777234, 100.561981),
        zoom: 7,
        mapTypeControl: true,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
          position: google.maps.ControlPosition.TOP_CENTER
        }
      };
      var map = new google.maps.Map(mapCanvas ,mapOptions);
    }
    </script> -->

<script>
  function myMap() {
        var mapOptions = {
          center: {lat: 13.847860, lng: 100.604274},
          zoom: 18,
        }
            
        var maps = new google.maps.Map(document.getElementById("map"),mapOptions);
        
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found. lat: ' + position.coords.latitude + ', lng: ' + position.coords.longitude + ' ');
            infoWindow.open(maps);
            // map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
        
    }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                          'Error: The Geolocation service failed.' :
                          'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
  }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhwvJrkjYHfpjd2DKiPhcqliTOo9NssAI&callback=myMap"></script>

<?php

$js = <<< JS

$("#tblcategories-catework").on("click", function() {
    
    var current_value = this.value;

    if (current_value == "Ph") {
        
      document.getElementById("hide-elements").style.display = "block";
      document.getElementById("map").style.display = "none";
      document.getElementById("location1").style.display = "none";
      document.getElementById("location2").style.display = "none";
      document.getElementById("this-hide1").style.display = "block";
      document.getElementById("this-hide2").style.display = "block";

    } else if (current_value == "Ma") {
        
      document.getElementById("hide-elements").style.display = "block";
      document.getElementById("map").style.display = "none";
      document.getElementById("location1").style.display = "none";
      document.getElementById("location2").style.display = "none";
      document.getElementById("this-hide1").style.display = "none";
      document.getElementById("this-hide2").style.display = "none";

    } else if (current_value == "Dr") {
        
      document.getElementById("hide-elements").style.display = "none";
      document.getElementById("map").style.display = "block";
      document.getElementById("location1").style.display = "block";
      document.getElementById("location2").style.display = "block";

    }

});

JS;
 
// register your javascript
$this->registerJs($js);

?>
