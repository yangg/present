<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\assets\vendor;

use yii\web\AssetBundle;

class PrismAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/prism';
    public $css = [
        'prism.css'
    ];
    public $js = [
        'prism.js',
    ];
}
