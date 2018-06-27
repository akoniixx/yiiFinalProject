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
?>

<div class="tbl-studio-form" >
	<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($cate, 'cateWork')->dropDownList(
        ArrayHelper::map($findOccupation, 'id', 'TH_name'), 
        ['prompt'=>'-- กรุณาเลือกอาชีพ --'])
    ?>

    <?= $form->field($cate, 'placeOfWork')->widget(Select2::classname(), [
      'data' => ArrayHelper::map(Locations::find()->orderBy(['location_name' => SORT_ASC])->all(), 'location_id', 'location_name'),
      'options' => ['placeholder' => Yii::t('search', 'เลือกจังหวัด') . '..', 'multiple' => true],
      'pluginOptions' => [
          'tags' => true,
          'tokenSeparators' => [',', ' '],
          'maximumInputLength' => 10
        ],
    ])->label('Tag Multiple'); ?>

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

        <div class="inline form-inline">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'architecture'])->label(false); ?>    
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn6.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">สถาปัตยกรรม</label>
            <div class="input-price">
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาครึ่งวัน', ['class' => 'control-label col-sm-6']) ?>
                <?= $form->field($cate, 'workDetails[]')->textInput(['type' => 'number', 'min' => 0, 'max' => 1000000, 'step' => 100, 'class' => 'price-box'])->label('ราคาเต็มวัน', ['class' => 'control-label col-sm-6']) ?>
            </div>
        </div>

        <div class="inline form-inline">
            <?= $form->field($cate, 'workDetails[]')->checkbox(['uncheck' => null, 'class' => 'checkbox-inline-type', 'value' => 'productAndFood'])->label(false); ?>    
            <?= Html::img(Yii::$app->request->baseUrl.'/img/pn7.png', ['alt'=>'some', 'class'=>'set-image']);?>
            <label class="checkbox-inline-type">สินค้า/อาหาร</label>
            <!-- <input type="hidden" name="quantity[]" value="-">
            <input type="hidden" name="quantity[]" value="-"> -->
        </div>
    </div>

    <div class="form-group text-center" style="padding-top: 50px;">
        <div style="padding-left: 15px; padding-right: 15px;">
            <?= Html::submitButton('ยืนยืน', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>