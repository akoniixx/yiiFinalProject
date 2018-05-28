<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\dialog\Dialog;
use yii\widgets\ActiveForm;
?>
<head>

</head>
<body>

<div class="head-bg" style="background-image: url('http://backgroundcheckall.com/wp-content/uploads/2017/12/background-img-4.jpg')">

</div>

<div class="content">
    <div class="container">
    <section class="section-about">
        <div class="animate-up animated">
            <div class="section-box">
                <div class="profile">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="profile-photo">
                                <img src="https://blog.onabags.com/wp-content/uploads/2013/05/oliviaraejames.jpg">
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <div class="profile-info">
                                <div class="profile-preword">
                                    
                                    <span><?= $textStatus->confirm_name ?></span>
                                    <?php echo Dialog::widget();
                                    ?>
                                    
                                        <button type="button" id="btn-alert" class="btn btn-primary" style="float: right;">เปลี่ยนรูปภาพประจำตัว</button>
                                    
                                </div>
                                <h1 class="profile-title">
                                    <span>I'm</span> <?= $modelStudio->studioName; ?>
                                </h1>
                                <h2 class="profile-position">ข้อมูลส่วนตัว</h2>
                            </div>
                            <ul class="profile-list">
                                <li class="clearfix">
                                    <strong class="title">ชื่อ</strong>
                                    <span class="cont"><?= $modelProfile->firstName."&nbsp". $modelProfile->lastName; ?></span>
                                </li>
                                <li class="clearfix">
                                    <strong class="title">เบอร์โทร</strong>
                                    <span class="cont"><?= $modelStudio->tel; ?></span>
                                </li>
                                <li class="clearfix">
                                    <strong class="title">อีเมล</strong>
                                    <span class="cont"><?= $modelProfile->email; ?></span>
                                </li>
                                <li class="clearfix">
                                    <strong class="title">ไลน์</strong>
                                    <span class="cont"><?= $modelStudio->lineID; ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="profile-social">
                    <ul class="social">
                        <a><i class="glyphicon glyphicon-camera" style="font-size:24px"></i></a>
                        <a><!-- <i class="glyphicon glyphicon-briefcase" style="font-size:24px"></i> --></a>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-skills">
        <div class="animate-up animated">
            <div class="section-title">
                <h2 class="inline-text">ช่างภาพ</h2>
                <p class="inline-text" style="float: right;">
                <?= Html::a('อัพโหลดรูป', Url::to(['tbl-studio/uploadform', 'id' => $modelStudio->id]), ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
            
            <div class="section-box">
                <!-- <h1>
                    Hiiiiiiiiiiiiiiiiiiiiiiiiiiiii
                </h1> -->
            <?php 
                if ($modelAlbum !== NULL) {
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '/tbl-studio/_albumView',
                        'summary' => false,
                        'itemOptions' => [
                            'class' => 'col-sm-6 col-md-3',
                        ],
                        'viewParams' => [
                            //'aName' => $aName,
                            'baseUrl' => $baseUrl,
                        ],
                    ]);
                }

                echo $id . " " . $tt->email . "<br>";
            ?>
                
            </div>
        </div>
    </section>
    </div>
</div>

</body>

<?php
$urlto = Url::to(['/tbl-studio/index']);
/*message: 'เปลี่ยนรูปภาพโปรไฟล์: <input type="file" name = "pimage" class="form-control">'+'<br>'+
                'เปลี่ยนรูปภาพพื้นหลัง: <input type="file" name = "cimage" class="form-control">',*/
$js = <<< JS
$("#btn-alert").on("click", function() {
    var id = "$modelStudio->id";
    var url = "$urlto";
    BootstrapDialog.show({

            message: function (dialogItself) {
                var formupload = $('<form action="'+url+'" method="POST"></form>');
                var plabel = 'เปลี่ยนรูปภาพประจำตัว';
                var pinput = $('<input type="file" name="UProfile[imgProfile]" class="form-control">');
                var clabel = 'เปลี่ยนรูปภาพพื้นหลัง:';
                var cinput = $('<input type="file" name="cimage" class="form-control">');
                var button = $('<button type="submit" class="btn btn-primary">อับโหลด</button>');
                formupload.append(plabel).append(pinput).append(clabel).append(cinput).append(button);
                return formupload;
            },

            
            buttons: [{
                label: 'อับโหลด',
                type: 'submit',
                cssClass: 'btn-primary',
            }, {
                label: 'ยกเลิก',
                action: function(dialogRef) {
                    dialogRef.close();
                }
            }]
        });
});

JS;
 
// register your javascript
$this->registerJs($js);

?>