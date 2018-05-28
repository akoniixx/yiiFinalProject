<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

?>
<div class="tbl-album-view">

<?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '/tbl-album/_galleryView',
        'itemOptions' => [
            'class' => 'col-sm-6 col-md-3',
        ],
        'viewParams' => ['path' => $path,],
    ]);
?>

</div>
