<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\TblCategories;
use common\models\TblStudio;

/* @var $this yii\web\View */
/* @var $model common\models\Reservations */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="reservations-form">

    <?php $form = ActiveForm::begin(); ?>

	<div class="col-md-6 col-sm-12">
	    <?= $form->field($modelDetail, 'name')->textInput() ?>
	</div>

	<div class="col-md-6 col-sm-12">
	    <?= $form->field($modelDetail, 'tel')->textInput(['maxlength' => true, 'value' => $userModel ? $userModel->tel : null]) ?>
	</div>

	<div class="col-md-6 col-sm-12">
	    <?= $form->field($modelDetail, 'work')->dropDownList(ArrayHelper::map($findOccupation, 'id', 'TH_name')) ?>
	</div>

	<div class="col-md-6 col-sm-12">
	    <?= $form->field($modelDetail, 'work_detail')->dropDownList(ArrayHelper::map($findWorkType, 'id', 'name_type_TH')) ?>
	</div>

	<div class="col-md-6 col-sm-12">
	    <?= $form->field($modelDetail, 'type')->dropDownList($modelDetail->statusWork) ?>
	</div>

	<?php if (isset($currentDate)) { ?>
		<div class="col-md-6 col-sm-12">
			<label class="control-label"><?= Yii::t('common', 'Date Of Work') ?></label>
			<?= DatePicker::widget([
			    'name' => 'dp_disable',
			    'value' => $currentDate,
			    'disabled' => true
			]); ?>
		</div>
	<?php } else { ?>
		<div class="col-md-6 col-sm-12">
			<label class="control-label"><?= Yii::t('common', 'Date Of Work') ?></label>
		    <?= DatePicker::widget([
			    'name' => 'dp_2',
			    'model' => $modelDetail,
			    'attribute' => 'reservation_date',
			    // 'type' => DatePicker::TYPE_COMPONENT_PREPEND,
			    // 'value' => time(),
			    'pluginOptions' => [
			        'autoclose'=>true,
			        'format' => 'yyyy-mm-dd',
			        'todayHighlight' => true,
			        'eventBackgroundColor' => 'red',
			    ]
			]); ?> 
		</div>
	<?php } ?>

	<div class="col-md-12 col-sm-12">
	    <?= $form->field($modelDetail, 'contact')->textarea(['rows' => '6']) ?>
	</div>

    <div class="form-group col-sm-12 col-md-12" style="text-align: center;">
        <?= Html::submitButton(Yii::t('common', 'Confirm'), ['class' => 'btn btn-info', 'style' => 'width: 30%']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
