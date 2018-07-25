<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ReservationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reservations', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::button('Create', ['id' => 'reservationsButton', 'value' => Url::to(['create']), 'class' => 'btn btn-info btn-lg']) ?>
    </p>

    <?php
            
        Modal::begin([
                'header' => '<h4>Reservations</h4>',
                'id'     => 'modal',
                'size'   => 'modal-lg',
        ]);
        
        echo "<div id='modelContent'></div>";
        
        Modal::end();
                
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'studio_id',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
