<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\rating\StarRating;

$newModel = $model->profile;
if ($newModel->userType == 'U') {
    $name = $newModel->firstName ." " . $newModel->lastName;
    $url = Url::to(['/profile/view', 'id' => $model->user_id]);
} else {
    $name = $model->studio->studioName;
    $url = Url::to(['/tbl-studio/fanpage', 'id' => $model->studio->id]);
}

if ($newModel->imgProfile == 'profile-default-icon.png') {
    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/default/';
    $img_profile = $url_profile_img . $newModel->imgProfile;
} else {
    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/profile'.$newModel->id.'/';
    $img_profile = $url_profile_img . $newModel->imgProfile;
}
?>

<div class="post-heading">
    <div class="pull-left image">
        <img src="<?= $img_profile ?>" class="img-circle avatar" alt="user profile image">
    </div>
    <div class="pull-left meta">
        <div class="title h5">
            <a href="<?= $url ?>"><b><?= $name ?></b></a>
            แสดงความคิดเห็น.
        </div>
        <h6 class="text-muted time"><?= date("Y-m-d H:i:s", $model->created_at) ?></h6>
        <h6 style="font-size: 6px">
        <?= StarRating::widget([
            'name' => 'rating_35',
            'value' => $model->rating,
            'pluginOptions' => [
                'displayOnly' => true,
                'size' => 'sm',
            ]
        ]); ?>
        </h6>
    </div>
</div> 
<div class="post-description"> 
    <p><?= $model->comment ?></p>
</div>