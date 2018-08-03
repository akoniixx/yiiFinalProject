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
$studioId = $id;
?>
<head>
    <style>
    .fc-day {
        cursor: pointer;
    }
    .fc-day:hover {
        background-color: #eef3f5;
    }
    </style>
</head>
<div class="reservations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
            
        Modal::begin([
                'header' => '<h4>Reservations</h4>',
                'id'     => 'modal',
                'size'   => 'modal-md',
        ]);
        
        echo "<div id='modalContent' style='display: inline-block'></div>";
        
        Modal::end();
                
    ?>

    <?= yii2fullcalendar\yii2fullcalendar::widget([
      'options' => [
        'lang' => 'th',
        // 'background-color' => 'red',
      ],
      'clientOptions' => [
        // 'selectable' => true,
        'selectHelper' => true,
        'droppable' => true,
        'editable' => true,
        'eventClick' => 'js:function(date, jsEvent, view) {
            alert("a day has been clicked!");
        }',
        'defaultDate' => date('Y-m-d'),
      ],
      'events' => $events,
    ]); ?>

    <?= 
        $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
            'calendar' => true,
        ]);
    ?>

</div>

<?php

$js = <<< JS
    $(document).ready(function() {

        $(document).on("click",".fc-day",function() {
            // var x = document.getElementsByClassName("fc-event-container");
            // if(x != null) {
            //     alert('5555');
            // }

            var date = $(this).attr('data-date');
            var id = $id;
            $.get('index.php?r=reservations/create', {'date':date, 'id':id}, function(data, id) {
             $('#modal').modal('show')
             .find('#modalContent')
             .html(data);
            });
            // alert(id);
        });

    });
JS;
$this->registerJs($js);

?>