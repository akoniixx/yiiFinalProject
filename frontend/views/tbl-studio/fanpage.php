<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\dialog\Dialog;
// use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use common\models\TblCategories;
use yii\bootstrap\Modal;

$this->registerJsFile("//cdn.jsdelivr.net/jquery/1/jquery.min.js");
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js");
?>
<head>
<style>
    .avatar-wrapper{
    position: relative;
    height: 200px;
    width: 200px;
    margin: 20px auto;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 1px 1px 15px -5px black;
    transition: all .3s ease;
    &:hover{
        transform: scale(1.05);
        cursor: pointer;
    }
    &:hover .profile-pic{
        opacity: .5;
    }
    .profile-pic {
        height: 100%;
        width: 100%;
        transition: all .3s ease;
        &:after{
            /*font-family: FontAwesome;*/
            content: "\f007";
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            font-size: 190px;
            background: #ecf0f1;
            color: #34495e;
            text-align: center;
        }
    }
    /*.upload-button {
        position: absolute;
        top: 0; left: 0;
        height: 100%;
        width: 100%;
        .fa-arrow-circle-up{
            position: absolute;
            font-size: 234px;
            top: -17px;
            left: 0;
            text-align: center;
            opacity: 0;
            transition: all .3s ease;
            color: #34495e;
        }
        &:hover .fa-arrow-circle-up{
            opacity: .9;
        }
    }*/
}

.file-upload {
  color: #878787;
}
.file-upload::-webkit-file-upload-button {
  background: #56c8d2;
  border: 2px solid #56c8d2;
  border-radius: 4px;
  color: #fff;
  cursor: pointer;
  font-size: 12px;
  outline: none;
  padding: 10px 25px;
  text-transform: uppercase;
  transition: all 1s ease;
}

.file-upload::-webkit-file-upload-button:hover {
  background: #fff;
  border: 2px solid #535353;
  color: #000;
}
.cover-image {
    top: 0;
    left: 0;
    right: 0;
    z-index: 1;
    position: absolute;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    width: 100%;
    max-height: 760px;
}
</style>
</head>
<body>

<div class="head-bg">
<img id="blah" class="cover-image" src="<?= $img_cover ?>" alt="your image" />

</div>

<div class="content">
    <div class="container">
    <section class="section-about">

        <?php if (Yii::$app->studio->getStudioId() == $id) { ?>

            <?php $form = ActiveForm::begin([
                'action' => Url::to(['tbl-studio/upload-cover-image', 'id' => $id]),
                'options' => ['enctype' => 'multipart/form-data']
            ]); ?>
            
            <?= $form->field($studio, 'cover_image')->fileInput(['class' => 'file-upload', 'id' => 'imgInp'])->label(false); ?>
            <!-- <input type='file' id="imgInp" /> -->
            <div class="form-group" style="display: none;" id="check-cover-image">
                <?= Html::submitButton('อับโหลด', [
                    'class' => 'btn btn-info',
                    'id' => 'ok',
                    // 'style' => 'display:none'
                ]) ?>
                
                <?= Html::a('ยกเลิก', null, [
                    'class'=>'btn btn-default',
                    'onclick' => '(function ( $event ) {
                        document.getElementById("imgInp").style.display = "block";
                        document.getElementById("check-cover-image").style.display = "none";
                        location.reload();
                     })();'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        <?php } ?>

        <div class="animate-up animated">
            <div class="section-box">
                <div class="profile">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <!-- <div class="profile-photo"> -->
                            
                                <div class="avatar-wrapper">
                                    <img class="profile-pic" src="<?= $img_profile ?>" />
                                    <!-- <div class="upload-button">
                                        <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                    </div> -->
                                    <!-- <input class="file-upload" type="file" accept="image/*"/> -->
                                </div>

                                <!-- <img src="https://blog.onabags.com/wp-content/uploads/2013/05/oliviaraejames.jpg">
                            </div> -->
                            <?php if (Yii::$app->studio->getStudioId() == $id) { ?>

                                <?php $form = ActiveForm::begin([
                                    'action' => Url::to(['tbl-studio/upload-profile-image', 'id' => $id]),
                                    'options' => ['enctype' => 'multipart/form-data']
                                ]); ?>
                                
                                <!-- <button class='btn  btn-primary upload-btn'>upload</button> -->
                                <?= $form->field($profile, 'imgProfile')->fileInput(['class' => 'file-upload', 'id' => 'file-upload-profile'])->label(false); ?>

                                <div class="form-group" style="text-align: center; display: none;" id="check">
                                    <?= Html::submitButton('อับโหลด', [
                                        'class' => 'btn btn-info',
                                        'id' => 'ok',
                                        // 'style' => 'display:none'
                                    ]) ?>
                                    
                                    <?= Html::a('ยกเลิก', null, [
                                        'class'=>'btn btn-default',
                                        'onclick' => '(function ( $event ) {
                                            document.getElementById("file-upload-profile").style.display = "block";
                                            document.getElementById("check").style.display = "none";
                                            location.reload();
                                         })();'
                                    ]) ?>
                                </div>
                                
                                <!-- <input type='file' name ='upload-file' id='upload-file' multiple> -->

                                <?php ActiveForm::end(); ?>

                            <?php } ?>

                            <div class="col-xs-12" style="margin-top: 35px">
                                <h5 style="font-size: 16px"><?= Yii::t('user', 'Page View') ?> : <?= $modelStudio->view_count ?> ครั้ง</h5>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <div class="profile-info">
                                <div class="profile-preword">
                                    
                                    <span><?= $textStatus->confirm_name ?></span>
                                    <?php echo Dialog::widget();
                                    ?>
                                    
                                        <!-- <button type="button" id="btn-alert" class="btn btn-primary" style="float: right;">เปลี่ยนรูปภาพประจำตัว</button>  -->                   
                                    
                                </div>
                                <h1 class="profile-title">
                                    <!-- <span>I'm</span> --> <?= $modelStudio->studioName; ?>
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
                <h2 class="inline-text"><?= $modelCategory->occupations->TH_name ?></h2>
                <?php if (Yii::$app->studio->getStudioId() == $id) { ?>
                    <p class="inline-text" style="float: right;">
                    <?= Html::a('อัพโหลดรูป', Url::to(['tbl-studio/uploadform', 'id' => $modelStudio->id]), ['class' => 'btn btn-primary']) ?>
                    </p>
                <?php } else { ?>
                    <p class="inline-text" style="float: right;">
                    <?php /*Html::a('จอง', Url::to(['tbl-studio/uploadform', 'id' => $modelStudio->id]), ['class' => 'btn btn-info btn-lg'])*/ ?>
                    <?= Html::button('จอง', ['id' => 'reservationsButton', 'value' => Url::to(['reservations/create', 'id' => $modelStudio->id]), 'class' => 'btn btn-info btn-lg']) ?>
                    </p>

                <?php } ?>
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

                //echo $id . " " . $tt->email . "<br>";
            ?>
                
            </div>
        </div>
    </section>

    <?php if($modelCategory->cateWork == TblCategories::DRESS_RENTAL) { ?>
    <section>
        <?php
        $coord = new LatLng(['lat'=>$arrayLocation[0],'lng'=>$arrayLocation[1]]);
        $map = new Map([
            'center'=>$coord,
            'zoom'=>14,
            'width'=>'100%',
            'height'=>'400',
        ]);
        // foreach($contacts as $c){
          $coords = new LatLng(['lat'=>$arrayLocation[0],'lng'=>$arrayLocation[1]]);  
          $marker = new Marker(['position'=>$coords]);
          $marker->attachInfoWindow(
            new InfoWindow([
                'content'=>'
             
                    <h4>'.$modelStudio->studioName.'</h4>
                      <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <td>ที่อยู่</td>
                            <td>'.$modelStudio->id.'</td>
                        </tr>
                      </table>

                '
            ])
          );
          
          $map->addOverlay($marker);
        // }
        ?>
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-signal"></i> การแสดงแผนที่ Google Map จากฐานข้อมูล</h3>
            </div>
            <div class="panel-body">
                <?php
                echo $map->display();
                ?>
            </div>
        </div>
    </section>
    <?php } ?>
    </div>
</div>

<?php
            
    Modal::begin([
            'header' => '<h4>Reservations</h4>',
            'id'     => 'modal',
            'size'   => 'modal-md',
    ]);
    
    echo "<div id='modelContent' style='display: inline-block'></div>";
    
    Modal::end();
            
?>

</body>

<?php
$urlto = Url::to(['/tbl-studio/index']);
/*message: 'เปลี่ยนรูปภาพโปรไฟล์: <input type="file" name = "pimage" class="form-control">'+'<br>'+
                'เปลี่ยนรูปภาพพื้นหลัง: <input type="file" name = "cimage" class="form-control">',*/
// $js = <<< JS
// $("#btn-alert").on("click", function() {
//     var id = "$modelStudio->id";
//     var url = "$urlto";
//     BootstrapDialog.show({

//             message: function (dialogItself) {
//                 var formupload = $('<form action="'+url+'" method="POST"></form>');
//                 var plabel = 'เปลี่ยนรูปภาพประจำตัว';
//                 var pinput = $('<input type="file" name="UProfile[imgProfile]" class="form-control">');
//                 var clabel = 'เปลี่ยนรูปภาพพื้นหลัง:';
//                 var cinput = $('<input type="file" name="cimage" class="form-control">');
//                 var button = $('<button type="submit" class="btn btn-primary">อับโหลด</button>');
//                 formupload.append(plabel).append(pinput).append(clabel).append(cinput).append(button);
//                 return formupload;
//             },

            
//             buttons: [{
//                 label: 'อับโหลด',
//                 type: 'submit',
//                 cssClass: 'btn-primary',
//             }, {
//                 label: 'ยกเลิก',
//                 action: function(dialogRef) {
//                     dialogRef.close();
//                 }
//             }]
//         });
// });

// JS;
 
// // register your javascript

$js = <<< JS

$(document).ready(function() {
    
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.profile-pic').attr('src', e.target.result);
            }
    
            reader.readAsDataURL(input.files[0]);
            document.getElementById("file-upload-profile").style.display = "none";
            document.getElementById("check").style.display = "block";

        }
    }

    
   
    $("#file-upload-profile").on('change', function(){
        readURL(this);
    });
    
    $("#upload-button").on('click', function() {
       $(".file-upload-profile").click();
    });

});

function readURLCover(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    document.getElementById("imgInp").style.display = "none";
    document.getElementById("check-cover-image").style.display = "block";
  }
}

$("#imgInp").change(function() {
  readURLCover(this);
});

JS;

$this->registerJs($js);

?>