<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\UProfile;
use common\models\TblStudio;
use common\models\VerifyMember;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php

    $id = Yii::$app->user->getId();
    $identity = UProfile::find()->where(['userType' => 'P', 'u_id' => $id])->one();
    
    if (!Yii::$app->user->isGuest && isset($identity)) { 
        $sid = TblStudio::find()->where(['u_id' => $id])->one();
        if (!isset($sid)) {
            $sid = $sid->u_id;
        }
    }

        
    NavBar::begin([
        'brandLabel' => 'PICPOST',
        //'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        //['label' => 'Original', 'url' => ['/site/originalindex']],
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else if(isset($identity)) {
        $vid = VerifyMember::findOne(['studio_id' => $sid->id]);
        $menuItems[] = /*'<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';*/
            ['label' => Yii::$app->user->identity->username, 'items' => [
                [
                    'label' => 'หน้าโปรไฟล์',
                    'url' => ['/tbl-studio/fanpage', 'id' => $sid->id],
                    'visible' => !Yii::$app->user->isGuest && $identity->userType ? TRUE : FALSE,
                ],
                ['label' => 'สร้างอัลบั้ม', 'url' => ['/tbl-studio/uploadform', 'id' => $sid->id]],
                ['label' => 'เพิ่มอาชีพ', 'url' => ['/tbl-studio/createnewcareer', 'id' => $sid->id]],
                ['label' => 'แก้ไขข้อมูลส่วนตัว', 'url' => ['/tbl-studio/update', 'id' => $sid->id]],
                [
                    'label' => 'ยืนยันตัวตน', 'url' => ['/verify-member/verifymember', 'id' => $sid->id],
                    'visible' => empty($vid->verify_status) ? TRUE : FALSE,
                ],
                [
                    'label' => 'ยืนยันตัวตน (รอการตรวจสอบ) <span class="glyphicon glyphicon-refresh"></span>', ['url' => false, 'disabled' => 'disabled'], 'options'=>[
                    'style' => [
                        'color' => 'red',
                        'cursor' => 'not-allowed',
                        'font-size' => '14px'
                    ]],
                    'visible' => isset($vid->verify_status) && $vid->verify_status == 2 ? TRUE : FALSE,
                ],
                [
                    'label' => 'Verified Member <span class="glyphicon glyphicon-ok"style="color:green"></span>', 'url' => false, 'options'=>[
                    'style' => [
                        'color' => 'green',
                        'font-size' => '14px'
                    ]],
                    'visible' => isset($vid->verify_status) && $vid->verify_status == 50 ? TRUE : FALSE,
                ],
                
                '<li class="divider"></li>',
                ['label' => 'ออกจากระบบ', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
            ]];
    } else {
        $uid = UProfile::findOne(['u_id' => $id]);
        if ($uid->userType == 'A') {
            $menuItems[] = ['label' => Yii::$app->user->identity->username, 'items' => [
                ['label' => 'แก้ไขผู้ใช้งาน', 'url' => ['/tbl-studio/index']],
                ['label' => 'ตรวจสอบการยืนยันตัวตน', 'url' => ['/verify-member/index']],
                '<li class="divider"></li>',
                ['label' => 'ออกจากระบบ', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
            ]];
        } else {
            $menuItems[] = ['label' => Yii::$app->user->identity->username, 'items' => [
                ['label' => 'แก้ไขข้อมูลส่วนตัว', 'url' => ['/profile/view', 'id' => $uid->id],],
                ['label' => 'สร้างสตูดิโอ <span class="glyphicon glyphicon-home"style="color:#00bfff; padding-left:10px"></span>', 'url' => ['/tbl-studio/create'], 'linkOptions' => ['style' => 'color: #00bfff;']],
                '<li class="divider"></li>',
                ['label' => 'ออกจากระบบ', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
            ]];
        }
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
