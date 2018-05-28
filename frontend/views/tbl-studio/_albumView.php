<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

    <!-- <a href="#" class="thumbnail">
      <img src="https://i.pinimg.com/originals/c7/16/c7/c716c757a6f4ae3d198f04468163a2e4.jpg" alt="">
    </a> -->
    <div class="thumbnail">
    	<a href="<?= Url::to(['/tbl-album/detailgallery', 'id' => $model->albumID]); ?>">
	      	<img src="<?= $baseUrl.$model->image; ?>" alt="#">
	      	<div class="caption">
	        	<h4><?= $model->albumName; ?></h4>
	      	</div>
  		</a>
  	</div>

