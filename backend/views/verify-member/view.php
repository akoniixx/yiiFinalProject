<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\VerifyMember */
$this->registerJsFile("//code.jquery.com/jquery-3.3.1.min.js");
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css");
$this->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js");

//$this->title = $model->verify_id;
$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Verify Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="verify-member-view">

    <p>
        <?php //Html::a('Update', ['update', 'id' => $model->verify_id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->verify_status !== 'confirm') { ?>
            <?= Html::a('ยืนยัน', ['confirm_validation', 'id' => $model->verify_id], ['class' => 'btn btn-info', 'id' => 'comfirm']) ?>
        <?php } ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->verify_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'กดยืนยันเพื่อลบ',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'verify_id',
            //'img_idCard',
            [
            'format'=>'raw',
            'attribute'=>'img_idCard',
            'value'=> function($model) {
                //$path = Url::to(Yii::getAlias('@web').'/uploads/verify/'.$model->img_idCard);
                $path = '/yii2-project/frontend/web/uploads/verify/'.$model->img_idCard;
                return '<a href="'. $path .'"  data-fancybox="images">'.
                            '<img src="'. $path .'" alt="" style="height:200px;"/>
                        </a>';
                }
            ],
            //'img_profile',
            [
            'format'=>'raw',
            'attribute'=>'img_profile',
            'value'=> function($model) {
                //$path = Url::to(Yii::getAlias('@web').'/uploads/verify/'.$model->img_profile);
                $path = '/yii2-project/frontend/web/uploads/verify/'.$model->img_profile;
                return '<a href="'. $path .'"  data-fancybox="images">'.
                            '<img src="'. $path .'" alt="" style="height:200px;"/>
                        </a>';
                }
            ],
            'fname',
            'lname',
            'tel',
            'studio_id',
            'created_at',
        ],
    ]) ?>

    

</div>

<?php

$this->registerJS("
    $('#comfirm').click(function(){
        if(!confirm('ยืนยันการตรวจสอบ')) {
            return false;
        }
    });
");

?>
