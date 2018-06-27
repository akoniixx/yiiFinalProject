<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use yii\widgets\ActiveField;
use common\models\TblAlbum;

use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\TblStudio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-studio-form">


	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

	<?= $form->field($album, 'albumName')->textInput() ?>

	<?= $form->field($album, 'type')->dropdownList([
			'congratulation' => 'รับปริญญา',
			'fashion' => 'ภาพบุคคล/แฟชัน',
			'wedding' => 'งานแต่ง',
			'pre-wedding' => 'พรีเวดเด้ง',
			'event' => 'งานอีเวนต์',
			'architecture' => 'สถาปัตยกรรม',
			'productAndFood' => 'สินค้า/อาหาร',
		]) ?>

    <?php //echo $form->field($model, 'gimages[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'gimages[]')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*', 'multiple' => true], ]); ?>

    <?= '<label class="control-label">Add Attachments</label>';
	 FileInput::widget([
	    'model' => $model,
	    'name' => 'attachment_1[]',
	    'options' => ['multiple' => true]
	]); ?>

    <button type="submit" class="btn btn-primary" style="text-align: center;">Submit</button>
 
<?php ActiveForm::end() ?>
</div>

<?php
	/*echo print_r($name) . "<br>";
	foreach ($name['0'] as $value) {
		echo $value;
	}
	echo "<br>";
	echo $id;*/
?>
