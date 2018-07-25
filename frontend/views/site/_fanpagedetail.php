<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

// $value = ArrayHelper::getValue($model, 'foo.bar.name');
// $category = $model->categories;
// $oc = $test->occupations;
// $map = ArrayHelper::map($category,'id','cateWork');
// $list = implode(" ", $map);
$find_profile = $model->studio->userProfile->imgProfile;
$bg_cover = $model->studio->cover_image;
// $img_profile = isset($find_profile) ? $find_profile : 'hooo';
if ($find_profile == 'profile-default-icon.png') {
    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/default/';
    $img = $url_profile_img . $find_profile;
} else {
    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/profile'.$model->studio->userProfile->id.'/';
    $img = $url_profile_img . $find_profile;
}
if ($bg_cover == 'background-default.png') {
    $url_cover_img = Yii::getAlias('@web').'/uploads/profile/default/';
    $bg = $url_cover_img . $bg_cover;
} else {
    $url_cover_img = Yii::getAlias('@web').'/uploads/profile/profile'.$model->studio->userProfile->id.'/';
    $bg = $url_cover_img . $bg_cover;
}
?>


<!-- <div class="col-sm-3"> -->
<a href="<?= Url::to(['/tbl-studio/fanpage', 'id' => $model->s_id]); ?>" class="text-link" style="text-decoration: none;">
  <div class="team boxed-grey" style="background-image: url(<?= $bg ?>); background-size: 500px 300px; background-repeat: no-repeat;">
  	<div class="inner">      
    	<h4><?= $model->studio->studioName; ?></h4>
        <p class="subtitle"><?= $model->occupations->TH_name; ?></p>
        <div class="avatar">
        	<img src="<?= $img ?>" class="img-responsive img-circle" />
        </div>
    </div>
  </div>
</a>
<!-- </div> -->
