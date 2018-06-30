<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Occupation;

$find_profile = $model->studio->userProfile->imgProfile;
// $img_profile = isset($find_profile) ? $find_profile : 'hooo';
if ($find_profile == 'profile-default-icon.png') {
    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/default/';
    $img = $url_profile_img . $find_profile;
} else {
    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/profile'.$model->studio->userProfile->id.'/';
    $img = $url_profile_img . $find_profile;
}
$category = $model->studio->categories;
$map = ArrayHelper::map($category,'id','cateWork');
$list = implode(" ", $map);
$find = Occupation::find()->where(['initials' => $map])->all();
// $text = $find->TH_name;
$arr = [];
foreach ($find as $key => $value) {
  $arr[] = $value->TH_name;
}
$array = [];
foreach ($category as $key => $value) {
  $array[] = $value->s_id;
}
?>
<a href="<?= Url::to(['/tbl-studio/fanpage', 'id' => $model->studio->id]); ?>" class="text-link" style="text-decoration: none;">
<div class="thumbnail right-caption col-sm-12 col-md-3">
  <div class="caption col-sm-3">
    <img src="<?= $img ?>">
  </div>
</div>
</a>
<div class="col-sm-12 col-md-9">
  <!-- <div class="col-sm-12"> -->
  <a href="<?= Url::to(['/tbl-studio/fanpage', 'id' => $model->studio->id]); ?>" class="text-link" style="text-decoration: none;">
    <h3 class="studio-name">
      <?= $model->studio->studioName ?>
      <?php //$model->studio->categories->occupations->TH_name ?>
      <?php //$model->studio->confirmStatus->confirm_name ?>
    </h3>
  </a>
  <!-- </div> -->
  <div class="col-sm-6">
    <h4>อาชีพ : <?= $model->studio->tel ?></h4>
    <h4>เบอร์โทร : <?= $model->studio->tel ?></h4>
    <h4>ไลน์ : <?= $model->studio->lineID ?></h4>
    <h4>เว็บไซต์ : </h4>
  </div>
  <div class="col-sm-6" style="border-left: 1px solid #d4d4d4">
    <h4><?= implode(" | ", $arr); ?></h4>
    <p><?= implode(" ", $array) ?></p>
  </div>
</div>