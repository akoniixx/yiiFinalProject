<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UProfile */

$this->registerJsFile("//code.jquery.com/jquery-3.3.1.min.js");
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css");
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js");

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Uprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uprofile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'imgProfile',
            [
            'format'=>'raw',
            'attribute'=>'imgProfile',
            'value'=> function($model) {
                if ($model->userType == 'FB') {
                    $path = $model->imgProfile;
                } else {
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
            'u_id',
            'email:email',
        ],
    ]) ?>

</div>
