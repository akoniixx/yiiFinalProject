<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>

Enter some text: <input type="text" name="txt" value="Hello" onchange="myFunction(this.value)">

<?= $test; ?>

<p id="textt"></p>

<div ng-app="">
 
<p>Name: <input type="text" ng-model="name"></p>
<p>You wrote: {{ name }}</p>

</div>

<script>

function myFunction(val) {
    var x = val;
    document.getElementById("textt").innerHTML = "You selected: " + x;
}

</script>