<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/signup-confirm', 'authkey' => $user->auth_key]);
?>
สวัสดี <?= $user->email ?>,

กรุณาคลิกลิ้งนี้เพื่อยืนยันการสมัครสมาชิกของคุณ :

<?= Html::encode($resetLink) ?>