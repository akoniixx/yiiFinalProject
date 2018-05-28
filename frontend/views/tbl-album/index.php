<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TblAlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Albums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Album', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'albumID',
            'studioID',
            'albumName',
            'type',
            'image',
            //'create_time',
            //'update_time',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
