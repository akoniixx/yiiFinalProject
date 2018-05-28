<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Occupation;
use common\models\TblStudioSearch;
?>
<style>
    
footer {
  background-color: #f2f2f2;
  padding: 25px;
}

.boxed-grey {
background: #f9f9f9;
padding: 20px;
background-image: url(https://s3.amazonaws.com/Syntaxxx/background-gold-bokeh.jpg);
border-radius: 15px;
}
.avatar {
    margin-bottom: 20px;
}
.img-responsive {
    display: block;
    max-width: 100%;
    height: 50%;
    width: 50%;
}
.team p.subtitle {
    margin-bottom: 10px;
}
.inner {
	margin-bottom: -15px
}
div#masonry:hover .col-sm-3 { opacity: 0.8; }
div#masonry:hover .col-sm-3:hover { opacity: 1; } 

/* fallback for earlier versions of Firefox */

@supports not (flex-wrap: wrap) {
  div#masonry { display: block; }
  div#masonry img {  
  display: inline-block;
  vertical-align: top;
  }
}
.text-link {
  color: black;
  cursor: pointer;
}
.text-link p {
  font-size: 16px;
}
</style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <!-- <h1>My Portfolio</h1>      
    <p>Some text that represents "Me"...</p> -->
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
      <div class="input-group">
        <!-- <select id="searchbygenerals_currency" name="searchbygenerals[currency]" class="form-control">
            <option value="1">HUF</option>
            <option value="2">EUR</option>
        </select><span class="input-group-addon" style="width:0px; padding-left:0px; padding-right:0px; border:none;"></span> -->
        <!-- <input type="text" id="searchbygenerals_priceFrom" name="searchbygenerals[priceFrom]" class="form-control"> -->

        <?= $form->field($occupation, 'id')->dropDownList(
            ArrayHelper::map(Occupation::find()->all(), 'id','TH_name'),
            [
              'prompt' => '-- อาชีพ --',
              //'onchange' =>
            ]
          ); ?>

        <?= $form->field($searchModel, 'searchStudio')->label(false)->textInput(['placeholder' => 'Search']); ?>
        
    </div>
    <div class="form-group">
        <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-info']); ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>

<div class="container bg-3" id="masonry">    
  <h3>Some of my Work</h3><br>
  <div class="row">
    <?=
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '/site/_fanpagedetail',
            'summary' => false,
            'itemOptions' => [
                'class' => 'col-sm-3',
            ],
            /*'viewParams' => [
                'aName' => $aName,
                'baseUrl' => $baseUrl,
            ],*/
        ]);
    ?>
  </div>
</div><br>

<div class="container-fluid bg-3 text-center">    
  <div class="row">
    <div class="col-sm-3">
      <p>Some text..</p>
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-3"> 
      <p>Some text..</p>
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-3"> 
      <p>Some text..</p>
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-3">
      <p>Some text..</p>
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
    </div>
  </div>
</div><br><br>

<?php
  echo TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
    'items' => [
        [
            'label' => 'One',
            'content' => 'Anim pariatur cliche...',
            'active' => true
        ],
        [
            'label' => 'Two',
            'content' => 'Anim pariatur cliche...',
            'headerOptions' => ['style'=>'font-weight:bold'],
            'options' => ['id' => 'myveryownID'],
        ],
    ],
]);
?>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
