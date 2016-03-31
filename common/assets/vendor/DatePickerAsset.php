<?php

namespace common\assets\vendor;

use yii\web\AssetBundle;

class DatePickerAsset extends AssetBundle
{
    public $sourcePath = '@static/vendor/My97DatePicker';
    public $css = [
    ];
    public $js = [
        'WdatePicker.js',
    ];
    public $depends = [
    ];
}
