<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GraduationScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตารางแสดงรายละเอียดวันรับปริญญา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="graduation-schedule-index">

    <h2 style="font-family: 'Prompt', sans-serif;"><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('สร้างกำหนดการ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'schedule',
            [
                'attribute' => 'schedule',
                'value' => function ($data) {
                    return $data->university->name;
                },
            ],
            // 'details',
            [
                'attribute' => 'details',
                'value' => function ($data) {
                    return $data->graduationDetails->detail;
                },
            ],
            'date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
