<?php
use yii\helpers\Html;

Yii::$app->session->setFlash('success', 'ส่งข้อมูลสำเร็จ ทางเราจะรีบตรวจสอบข้อมูลให้ท่านโดยเร็ว ขอบคุณครับ !!');

?>

<p style="text-align: center;">
    <?= Html::a('ตกลง', ['tbl-studio/fanpage', 'id' => $id], ['class' => 'btn btn-success']) ?>
</p>