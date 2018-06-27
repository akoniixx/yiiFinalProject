<?php

use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\web\UploadedFile;
use yii\widgets\ActiveField;
use common\models\TblAlbum;
use common\models\Occupation;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use common\models\WorkType;

/* @var $this yii\web\View */
/* @var $model common\models\TblStudio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-studio-form">
	<div class="row">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
	<div class="col-sm-6 col-md-6">
		<?= $form->field($category, 'cateWork')->dropdownList(
			ArrayHelper::map(Occupation::find()->where(['initials' => $arrayOccupation])->all(), 'id', 'TH_name')
		) ?>
	</div>

	<div class="col-sm-6 col-md-6">
		<?= $form->field($album, 'albumName')->textInput() ?>
	</div>

	<div class="col-md-6 col-md-offset-3">
		<?= $form->field($album, 'type')->dropdownList(
			ArrayHelper::map(WorkType::find()->all(), 'id', 'name_type_TH'),
	          [
	            'prompt' => '-- ประเภทงาน --',
	          ]
		) ?>
	</div>
	
	<div class="col-lg-12 col-md-12">
	    <?= $form->field($model, 'gimages[]')->widget(FileInput::classname(), [
	    'options' => ['accept' => 'image/*', 'multiple' => true], ]); ?>
	</div>
    

    <!-- <button type="submit" class="btn btn-primary" style="text-align: center;">Submit</button> -->
    <div class="form-group text-center" style="padding-top: 50px;">
        <div style="padding-left: 15px; padding-right: 15px;">
            <?= Html::submitButton('อัพโหลด', ['class' => 'btn btn-primary btn-block']) ?>
        </div>
    </div>
 
	<?php ActiveForm::end() ?>

	</div>
</div>

<?php
	/*echo print_r($name) . "<br>";
	foreach ($name['0'] as $value) {
		echo $value;
	}
	echo "<br>";
	echo $id;*/
?>
