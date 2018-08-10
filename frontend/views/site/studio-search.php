<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Occupation;
use common\models\TblStudioSearch;
use kartik\select2\Select2;
use common\models\Locations;
use common\models\WorkType;

?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<style>
    
footer {
  background-color: #f2f2f2;
  padding: 25px;
}

.boxed-grey {
background: #f9f9f9;
padding: 20px;
background-image: url(https://s3.amazonaws.com/Syntaxxx/background-gold-bokeh.jpg);
border-radius: 15px;
}
.avatar {
    margin-bottom: 20px;
}
.img-responsive {
    display: block;
    max-width: 100%;
    height: 50%;
    width: 50%;
}
.team p.subtitle {
    margin-bottom: 10px;
}
.inner {
    margin-bottom: -15px
}
div#masonry:hover .col-sm-3 { opacity: 0.8; }
div#masonry:hover .col-sm-3:hover { opacity: 1; } 

/* fallback for earlier versions of Firefox */

@supports not (flex-wrap: wrap) {
  div#masonry { display: block; }
  div#masonry img {  
  display: inline-block;
  vertical-align: top;
  }
}
.text-link {
  color: black;
  cursor: pointer;
}
.text-link p {
  font-size: 16px;
}
</style>

<div class="container bg-3" id="masonry">    
  <h3><?= Yii::t('search', 'Search Result') ?> <?= substr($resultText, 0, -2) ?></h3><br>
  <div class="row">
    <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '/site/_listView',
            // 'summary' => false,
            'itemOptions' => [
                'class' => 'col-sm-12 col-md-12',
                'style' => [
                  'padding' => '15px',
                  'border' => '1px solid #b3b3b3',
                  'margin-top' => '10px',
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