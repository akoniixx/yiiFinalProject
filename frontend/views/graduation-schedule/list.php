<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
use yii\bootstrap\ActiveForm;
?>
<style>
.thumbnail {
	margin-bottom: 0px;
}
.thumbnail.right-caption > img {
    float: left;
    margin-right: 9px;
}

.thumbnail.right-caption {
    float: left;
}

.thumbnail.right-caption > .caption {
    padding: 4px;
}

.image {
  display: table-cell;    
}

.caption {
    /*width: 100%;*/
    display: table-cell;
    /*vertical-align: top;*/
    height: 180px;
    width: 100%;
    display: inline-block;
    vertical-align: top;
    position: relative;
}

.caption > img {
	/*max-width: 200px;*/
	 max-height: 100%;
    max-width: 100%;
    width: auto;
    height: auto; 
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}

@media (max-width: 768px) {
    .image, .caption {
      display: block; 
    }   
}

.studio-name {
	margin-top: 0px;
	padding: 5px;
	background-color: #3c3c3c;
	color: white;
}
</style>

<div class="container bg-3" id="masonry">    
  <h3><?= Yii::t('search', 'Search Result') ?></h3><br>
  <div class="row">
    <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '/graduation-schedule/_listViews',
            'summary' => false,
            'itemOptions' => [
                'class' => 'col-sm-12 col-md-12',
                'style' => [
                	'padding' => '15px',
                	'border' => '1px solid #b3b3b3',
                	'margin-bottom' => '10px',
                	'border-radius' => '4px',
                    'box-shadow' => '2px 2px 2px #b3b3b3',
                ],
            ],
            /*'viewParams' => [
                'aName' => $aName,
                'baseUrl' => $baseUrl,
            ],*/
        ]);
    ?>
  </div>
</div><br>