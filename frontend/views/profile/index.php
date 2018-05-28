<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uprofiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uprofile-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Uprofile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'firstName',
            'lastName',
            'tel',
            'userType',
            //'u_id',
            //'email:email',
            //'imgProfile',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
