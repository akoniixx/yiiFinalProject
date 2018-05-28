<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TblStudioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Studio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-studio-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
        
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'userID',
            'url:url',
            'studioName',
            //'email:email',
            //'tel',
            'lineID',
            //'placeOfWork:ntext',
            //'workType',
            //'coverImg',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
