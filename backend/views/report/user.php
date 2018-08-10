<?php
$this->title = 'จำนวนผู้สมัครสมาชิกต่อเดือน';
$this->params['breadcrumbs'][] = $this->title;
use yii\grid\GridView;
use miloschuman\highcharts\Highcharts;
?>

<div class="col-sm-12" style="margin-top: 15px">
    <button class="btn btn-primary pull-right" onclick="changeGraph()">เปลี่ยนการฟ</button>
</div>
<!-- ส่วนแสดงกราฟ -->
<div class="panel panel-info" id="graph-1" style="margin-top: 15px">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"></i>
            จำนวนผู้สมัครสมาชิกต่อเดือน
        </h3>
    </div>
    <div class="panel-body">
        <?php

        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'จำนวนผู้สมัครสมาชิกต่อเดือน (การฟเส้น)'],
                'xAxis' => [
                    'categories' => $arrayMonth,
                ],
                'yAxis' => [
                    'title' => ['text' => 'จำนวน(คน)']
                ],
                'series' => [
                    // ['name' => 'Jane', 'data' => array_map('intval',$arrayValue)],
                    // ['name' => 'John', 'data' => ['0' => 5,'1' => 7,'2' => 3]]
                    [
                        'type' => 'line',
                        'name' => 'ผู้ใช้ทั่วไป',
                        'data' => array_map('intval',$arrayValue),
                    ],
                    [
                        'type' => 'line',
                        'name' => 'ช่างภาพ',
                        'data' => array_map('intval',$arrayPh),
                    ],
                    [
                        'type' => 'line',
                        'name' => 'ช่างแต่งหน้า',
                        'data' => array_map('intval',$arrayMa),
                    ],
                    [
                        'type' => 'line',
                        'name' => 'ร้านเช่าชุด',
                        'data' => array_map('intval',$arrayDr),
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>

<div class="panel panel-info" id="graph-2" style="margin-top: 15px; display: none;">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="glyphicon glyphicon-signal"></i>
            จำนวนผู้สมัครสมาชิกต่อเดือน
        </h3>
    </div>
    <div class="panel-body">
        <?php

        echo Highcharts::widget([
            'options' => [
                'title' => ['text' => 'จำนวนผู้สมัครสมาชิกต่อเดือน (กราฟแท่ง)'],
                'xAxis' => [
                    'categories' => $arrayMonth,
                ],
                'yAxis' => [
                    'title' => ['text' => 'จำนวน(คน)']
                ],
                'series' => [
                    [
                        'type' => 'column',
                        'name' => 'ผู้ใช้ทั่วไป',
                        'data' => array_map('intval',$arrayValue),
                    ],
                    [
                        'type' => 'column',
                        'name' => 'ช่างภาพ',
                        'data' => array_map('intval',$arrayPh),
                    ],
                    [
                        'type' => 'column',
                        'name' => 'ช่างแต่งหน้า',
                        'data' => array_map('intval',$arrayMa),
                    ],
                    [
                        'type' => 'column',
                        'name' => 'ร้านเช่าชุด',
                        'data' => array_map('intval',$arrayDr),
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>

<script type="text/javascript">
    function changeGraph() {

        var x = document.getElementById("graph-1");
        var y = document.getElementById("graph-2");
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "none";
        } else {
            x.style.display = "none";
            y.style.display = "block";
        }
    }
</script>
