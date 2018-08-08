<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\UProfile;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ข้อมูลผู้ใช้งาน';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uprofile-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่มผู้ใช้งาน', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'userType',
            [
                'attribute' => 'userType',
                'value' => function ($model) {
                    $newModel = new UProfile();
                    $type = $model->userType;
                    $status = $newModel->checkStatus($type);
                    return $status;
                },
            ],
            //'u_id',
            //'email:email',
            //'imgProfile',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
