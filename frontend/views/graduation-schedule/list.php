<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
use yii\bootstrap\ActiveForm;
?>

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