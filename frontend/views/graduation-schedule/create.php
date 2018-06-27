<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\University;
use common\models\GraduationDetails;
use kartik\select2\Select2;
// use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\GraduationSchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="graduation-schedule-form">

    <?php $form = ActiveForm::begin(); ?>
		
		<div class="col-sm-9 col-md-9">
			<?= $form->field($model, 'schedule')->widget(Select2::classname(), [
			    'data' => ArrayHelper::map(University::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
			    'options' => ['placeholder' => '... ' . Yii::t('schedule', 'Select University') . ' ...'],
			    'pluginOptions' => [
			        'allowClear' => true
			    ],
			]); ?>
		</div>
		<div class="col-sm-3 col-md-3">
		    <?= $form->field($model, 'details')->widget(Select2::classname(), [
			    'data' => ArrayHelper::map(GraduationDetails::find()->all(), 'initials', 'detail'),
			    // 'options' => ['placeholder' => '... ' . Yii::t('schedule', 'Select University') . ' ...'],
			    'pluginOptions' => [
			        'allowClear' => false
			    ],
			]); ?>
		</div>
		<div class="col-md-4 col-md-offset-4">
		    <?= DatePicker::widget([
			    'name' => 'dp_2',
			    'model' => $model,
			    'attribute' => 'date',
			    // 'type' => DatePicker::TYPE_COMPONENT_PREPEND,
			    // 'value' => time(),
			    'pluginOptions' => [
			        'autoclose'=>true,
			        'format' => 'yyyy-mm-dd',
			        'todayHighlight' => true
			    ]
			]); ?>   
		</div>
		<div class="col-md-12 col-md-12">
		    <div class="form-group text-center" style="padding-top: 50px;">
		        <div style="padding-left: 15px; padding-right: 15px;">
		            <?= Html::submitButton('ยืนยืน', ['class' => 'btn btn-primary btn-block']) ?>
		        </div>
		    </div>
		</div>

    <?php ActiveForm::end(); ?>

</div>
