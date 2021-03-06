<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

backend\assets\AppAsset::register($this);
common\assets\vendor\QrCodeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Code Present',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/demo/index']],
        ['label' => 'Components', 'url' => ['/demo/components']],
        ['label' => 'Code pens', 'url' => 'http://codepen.io/yangg/pens/public/', 'linkOptions' => ['target' => '_blank']],
        [
            'label' => 'More',
            'items' => [
                ['label' => 'Bootstrap+', 'url' => ['/demo/bootstrap'] ],
                ['label' => 'Vendor Plugins', 'url' => ['/demo/vendors'] ],
                ['label' => 'Extensions', 'url' => ['/demo/extensions']],
                ['label' => 'Javascript', 'url' => ['/demo/javascript']],
            ]
        ],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        $rightMenuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $rightMenuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $rightMenuItems,
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
    <a href="#page_qr" id="show_page_qr" title="View on mobile device">&copy; Brook <?= date('Y') ?></a>
</footer>
<div id="qr_pop" class="slide-in">
    <div class="trans-center">
        <span id="page_qr" style="line-height: 1;background: #fff;padding: 10px;display:inline-block" ></span>
        <p style="text-align: center;margin-top: 10px;color:#fff;">手机扫描二维码查看本页面</p>
    </div>
</div>
<?php $this->endBody() ?>
<script>
$(function()  {
    var isTouchDevice = function() {  return 'ontouchstart' in window || 'onmsgesturechange' in window; }();
    if(!isTouchDevice && $(document.documentElement).data('require-touch')) {
        location.href = '#page_qr'
    }

    var qrPop = $('#qr_pop');
    $('#show_page_qr').one('click', function() {
        $('#page_qr').qrcode({ text: location.href.replace(/#.*/g, ''), size: 260 });
    }).add(qrPop).on('click', function() {
        qrPop.toggleClass('in');
        if(!qrPop.hasClass('in')) { // hide qrPop
            history.replaceState(null, null, location.href.replace(/#.*/g, ''));
        }
    });
    $(window).on('hashchange', function() { // back forward
        if(!location.hash) {
            qrPop.removeClass('in');
        }
    });
    if(location.hash) {
        $('a[href="' + location.hash + '"]').click();
    }
});
</script>
</body>
</html>
<?php $this->endPage() ?>
