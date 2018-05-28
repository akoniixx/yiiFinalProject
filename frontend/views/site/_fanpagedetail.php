<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

//$value = ArrayHelper::getValue($model, 'foo.bar.name');
$map = ArrayHelper::map($model->categories,'id','cateWork');
$list = implode(" ", $map);
?>


<!-- <div class="col-sm-3"> -->
<a href="<?= Url::to(['/tbl-studio/fanpage', 'id' => $model->id]); ?>" class="text-link" style="text-decoration: none;">
  <div class="team boxed-grey">
  	<div class="inner">      
    	<h4><?= $model->studioName; ?></h4>
        <p class="subtitle"><?= $list; ?></p>
        <div class="avatar">
        	<img src="https://www.mills.edu/uniquely-mills/students-faculty/student-profiles/images/student-profile-gabriela-mills-college.jpg" class="img-responsive img-circle" />
        </div>
    </div>
  </div>
</a>
<!-- </div> -->
