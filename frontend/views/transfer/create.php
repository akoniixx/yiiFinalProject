<?php
use \yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use kartik\time\TimePicker;
use kartik\spinner\Spinner;
use kartik\widgets\TypeaheadBasic;
// use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
$this->registerCss("
div.field-transferslip-slip_image label.control-label:after {
    content: \" *\";
    color: red;
}
");
?>

<style>
	.box-title {
		background-color: #3c3c3c;
		color: white;
		padding: 4px;
	}
	.star {
		color: red;
		font-size: 18px;
	}
	.box-upload {
		margin-top: 30px;
	}
	.edit-label {
		text-align: left;
		padding-top: 2px;
		margin-bottom: 0;
	}
</style>

<div class="col-md-8 col-md-offset-2">
	<div class="box">
		<div class="box-title">
			<h3 style="margin: 0"><span class="glyphicon glyphicon-align-left"></span>&nbsp;&nbsp;รายละเอียดสำหรับการส่งข้อมูลการโอนเงิน</h3>
		</div>
		<div class="box-content">

			<!-- <div class="well">
				<?php Spinner::widget([
				    'preset' => Spinner::LARGE,
				    'color' => 'blue',
				    'align' => 'left'
				])?>
			</div> -->
			<h4>วิธีส่งหลักฐานการโอนเงิน</h4><hr>
			<p>1. กรอกข้อมูลในช่อที่มีเครื่องหมายดอกจัน (<span class="star">*</span>) ให้ครบถ้วน</p>
			<p>2. รูปถ่ายหลักฐานการโทนเงินควรเป็นรูปภาพที่ชัดและเห็นข้อมูลครบถ้วน ชัดเจน</p>
			<p>3. ในช่อที่<span style="color: red">ไม่มีเครื่องหมายดอกจัน</span> (<span class="star">*</span>) ผู้ใช้ลือกที่จะใส่ข้อมูลหรือไม่ก็ได้ แต่การใส่ข้อมูลให้ครบจะทำให้การตรวจสอบข้อมูลเป็นไปได้รวดเร็วยิ่งขึ้น </p><hr>
			<p>
				<span class="star">*</span> หลักฐานทั้งหมดจะถูกเก็บรักษาด้วยความปลอดภัยสูงสุด และจะไม่เปิดเผยสู่สาธารณะเป็นอันขาด
			</p>
		</div>
		<div class="box-upload">
			<h4 style="padding-bottom: 15px; text-align: center;">แบบฟอร์มการส่งหลักฐานการโอนเงิน</h4>
			
			<?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['enctype' => 'multipart/form-data']]); ?>
			
			<?= $form->field($slipModel, 'name')->textInput(); ?>

			<?= $form->field($slipModel, 'studio_name')->textInput(); ?>

			<?= $form->field($slipModel, 'bank_from')->widget(Typeahead::classname(), [
			    'options' => ['placeholder' => 'รายชื่อธนาคาร ...'],
			    'pluginOptions' => ['highlight'=>true],
			    'dataset' => [
			        [
			            'local' => $slipModel->bankList(),
			            'limit' => 10
			        ]
			    ]
			]); ?>

			<?= $form->field($slipModel, 'bank_to')->widget(Typeahead::classname(), [
			    'options' => ['placeholder' => 'รายชื่อธนาคาร ...'],
			    'pluginOptions' => ['highlight'=>true],
			    'dataset' => [
			        [
			            'local' => $slipModel->bankList(),
			            'limit' => 10
			        ]
			    ]
			]); ?>

			<?= $form->field($slipModel, 'bank_id')->textInput(['maxlength' => true]); ?>

			<?= $form->field($slipModel, 'amount')->textInput(); ?>

			<?= $form->field($slipModel, 'transfer_time')->widget(TimePicker::className(), [
				'name' => 't1',
			    'pluginOptions' => [
			        'showSeconds' => true,
			        'showMeridian' => false,
			        'minuteStep' => 1,
			        'secondStep' => 5,
			    ]
			]); ?>
			
			<?= $form->field($slipModel, 'tel')->textInput(['value' => $user->tel ? $user->tel : null, 'maxlength' => true]); ?>

			<?= $form->field($slipModel, 'slip_image')->fileInput(); ?>

			<div class="form-group" style="text-align: center;">
		        <?= Html::submitButton('ส่งข้อมูล', ['class' => 'btn btn-info', 'style' => 'width: 37%']) ?>
		    </div>

			<?php ActiveForm::end(); ?>
			<hr>
			<p style="color: red;">
				<span class="star">*</span> กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนส่งข้อมูล<br>
				<span class="star">*</span> ความเร็วในการตรวจสอบข้อมูลขึ้นอยู่กับข้อมูลที่ผู้ใช้กรอก
			</p>

		</div>
	</div>
</div>