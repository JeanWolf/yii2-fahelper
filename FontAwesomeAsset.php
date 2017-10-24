<?php

namespace jext\fahelper;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower/font-awesome';

    public $css = [
        'css/font-awesome.min.css',
    ];
}
