<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

//$value = ArrayHelper::getValue($model, 'foo.bar.name');
$category = $model->categories;
// $oc = $test->occupations;
$map = ArrayHelper::map($category,'id','cateWork');
$list = implode(" ", $map);
$find_profile = $model->userProfile->imgProfile;
// $img_profile = isset($find_profile) ? $find_profile : 'hooo';
if ($find_profile == 'profile-default-icon.png') {
    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/default/';
    $img = $url_profile_img . $find_profile;
} else {
    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/profile'.$model->userProfile->id.'/';
    $img = $url_profile_img . $find_profile;
}
?>


<!-- <div class="col-sm-3"> -->
<a href="<?= Url::to(['/tbl-studio/fanpage', 'id' => $model->id]); ?>" class="text-link" style="text-decoration: none;">
  <div class="team boxed-grey">
  	<div class="inner">      
    	<h4><?= $model->studioName; ?></h4>
        <p class="subtitle"><?= $list; ?></p>
        <div class="avatar">
        	<img src="<?= $img ?>" class="img-responsive img-circle" />
        </div>
    </div>
  </div>
</a>
<!-- </div> -->
