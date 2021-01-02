<?php
namespace app\assets;

use yii\web\AssetBundle;

class MaterialAsset extends AssetBundle{
  //  public $sourcePath = '@app/themes/material/assets';
    public $sourcePath='@app/themes/material';
    public $baseUrl = '@web';
    
    public $css = [
        'css/material.min.css',
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