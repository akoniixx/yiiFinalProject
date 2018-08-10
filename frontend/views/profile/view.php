<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\UProfile */

$this->registerJsFile("//code.jquery.com/jquery-3.3.1.min.js");
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css");
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js");

$this->title = 'แก้ไขข้อมูลส่วนตัว';
// $this->params['breadcrumbs'][] = ['label' => 'Uprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uprofile-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?php Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php /*DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'imgProfile',
            [
            'format'=>'raw',
            'attribute'=>'imgProfile',
            'value'=> function($model) {
                if ($model->userType == 'FB') {
                    $path = $model->imgProfile;
                } else if ($model->imgProfile == 'profile-default-icon.png') {
                    $url_profile_img = Yii::getAlias('@web').'/uploads/profile/default/';
                    $path = $url_profile_img . $model->imgProfile;
                }else {
                    $path = Url::to(Yii::getAlias('@web').'/uploads/profile/userid'.$models->id.'/'.$model->imgProfile);
                }
                return '<a href="'. $path .'"  data-fancybox="images">'.
                            '<img src="'. $path .'" alt="" style="height:200px;"/>
                        </a>';
                }
            ],
            'firstName',
            'lastName',
            'tel',
            'userType',
            'email:email',
        ],
    ])*/ ?>

    <?php

        echo DetailView::widget([
            'model' => $model,
            'template' => '<tr><th width="25%">{label}</th><td>{value}</td></tr>',
            'options' => [
                'class' => 'table table-striped',
            ],
            'attributes' => [
                [
                'format'=>'raw',
                'attribute'=>'imgProfile',
                'value'=> function($model) {
                    if ($model->userType == 'FB') {
                        $path = $model->imgProfile;
                    } else if ($model->imgProfile == 'profile-default-icon.png') {
                        $url_profile_img = Yii::getAlias('@web').'/uploads/profile/default/';
                        $path = $url_profile_img . $model->imgProfile;
                    }else {
                        $path = Url::to(Yii::getAlias('@web').'/uploads/profile/userid'.$models->id.'/'.$model->imgProfile);
                    }
                    return '<a href="'. $path .'"  data-fancybox="images">'.
                                '<img src="'. $path .'" alt="" style="height:200px;"/>
                            </a>';
                    }
                ],
                [
                    'label' => 'ชื่อ',
                    'attribute' => 'firstNameEditable',
                    'format' => 'raw',
                ],
                [
                    'label' => 'นามสกุล',
                    'attribute' => 'lastNameEditable',
                    'format' => 'raw',
                ],
                [
                    'label' => 'เบอร์โทร',
                    'attribute' => 'telEditable',
                    'format' => 'raw',
                ],
                'email:email',
            ]
        ]);
    ?>

</div>
