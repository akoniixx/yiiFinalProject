<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

?>
<div class="tbl-album-view">

<div class="col-md-12 col-sm-12">
	<h3><?= $modelAlbum->albumName ?></h3>
	<div class="col-md-12 col-sm-12" style="padding-bottom: 15px">
		<h4><?= str_replace("\n", "<br>\n", $modelAlbum->value); ?></h4>
	</div>
</div>

<?=
    ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '/tbl-album/_galleryView',
        'itemOptions' => [
            'class' => 'col-sm-6 col-md-3',
            'style' => [
            	'margin-top' => '10px',
            ],
        ],
        'viewParams' => ['path' => $path,],
    ]);
?>

</div>
