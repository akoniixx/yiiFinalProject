<?php
namespace frontend\themes\material;

use yii\web\AssetBundle;

class MaterialAsset extends AssetBundle{
    public $sourcePath = '@frontend/themes/material/assets';
    
    public $css = [
        'css/base.min.css',
        'css/project.min.css',
    ];
    public $js = [
        'js/base.min.js',
        'js/project.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}