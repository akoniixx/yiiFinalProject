<?php
use yii\helpers\Html;
use yii\helpers\Url;

$imgUrl = $path.'/'.$model->gimages;
$this->registerJsFile("//code.jquery.com/jquery-3.3.1.min.js");
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css");
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js");

?>
<head>
  <style>
    .frame {
      height: 200px; /*can be anything*/
      width: 100%; /*can be anything*/
      display: inline-block;
      vertical-align: top; /*not required*/
      position: relative;
    }

    img {
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
  </style>
</head>
    <div class="thumbnail frame">
    	<a href="<?= $imgUrl; ?>"  data-fancybox="images">
	      	<img src="<?= $imgUrl; ?>" alt="#">
	      	<!-- <div class="caption">
                      <h4><?= $imgUrl; ?></h4>
          </div> -->
  		</a>
  	</div>

