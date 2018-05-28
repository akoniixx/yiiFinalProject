<?php
use \yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
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
		margin-top: 40px;
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
			<h3 style="margin: 0"><span class="glyphicon glyphicon-align-left"></span>&nbsp;&nbsp;รายละเอียดสำหรับยืนยันตน</h3>
		</div>
		<div class="box-content">
			<h4>ขั้นตอนการยืนยันตัวตน Verified Member</h4><hr>
			<p>1. ถ่ายภาพ บัตรประจำตัวประชาชน ด้วยกล้องมือถือ หรือ กล้อง DSLR ให้เห็นเลขประจำตัวประชาชน และวันที่หมดอายุชัดเจน</p>
			<p>2. ถ่ายภาพ คุณเอง ขณะถือบัตรประจำตัวประชาชน ให้เห็นใบหน้าชัดเจน ด้วย กล้องมือถือ หรือ กล้อง DSLR</p>
			<!-- <p>3. ชำระเงินค่าดำเนินการ ยืนยันตัวตนบน GraduateTH จำนวนเงิน 500 บาท (ตลอดชีพ) พร้อมเศษสตางค์เพื่อง่ายในการตรวจสอบ จากนั้น
			    ถ่ายภาพ หลักฐานการชำระเงิน ให้เห็นจำนวนเงิน และวันเวลาที่ชำระเงินชัดเจน ด้วยกล้องมือถือ หรือ กล้อง DSLR</p> -->
			<p>3. นำภาพถ่าย ทั้ง 2 รายการ อับโหลดลงใน แบบฟอร์มด้านล่างนี้ พร้อมทั้ง ระบุชื่อ และเบอร์โทรศัพท์ติดต่อที่สามารถติดต่่อได้ สำหรับยืนยันตัวตน </p><hr>
			<p>
				<span class="star">*</span> เอกสารทั้งหมด ให้ทำลายน้ำระบุการใช้งาน "เฉพาะยืนยันตัวตนบน pixeventTH เท่านั้น" (ตามมาตรฐานการทำสำเนาเอกสาร)<br>
				<span class="star">*</span> หลักฐานทั้งหมดจะถูกเก็บรักษาด้วยความปลอดภัยสูงสุด และจะไม่เปิดเผยสู่สาธารณะเป็นอันขาด
			</p>
		</div>
		<div class="box-upload">
			<h4>แบบฟอร์มขอดำเนินการยืนยันตัวตน</h4>
			
			<?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['enctype' => 'multipart/form-data']]); ?>
			
			<?= $form->field($uploadModel, 'img_idCard')->fileInput(); ?>

			<?= $form->field($uploadModel, 'img_profile')->fileInput(); ?>

			<?= $form->field($uploadModel, 'fname')->textInput(); ?>

			<?= $form->field($uploadModel, 'lname')->textInput(); ?>
			
			<?= $form->field($uploadModel, 'tel')->textInput(); ?>

			<div class="form-group" style="text-align: center;">
		        <?= Html::submitButton('ส่งข้อมูล', ['class' => 'btn btn-info']) ?>
		    </div>

			<?php ActiveForm::end(); ?>
			<hr>
			<p style="color: red;">
				<span class="star">*</span> กรุณาตรวจสอบข้อมูลให้ครบถ้วนก่อนส่งข้อมูล<br>
				<span class="star">*</span> การตรวจสอบข้อมูลใช้เวลาไม่เกิน 24 ชั่วโมง กรุณารออย่างใจเย็น
			</p>

		</div>
	</div>
</div>