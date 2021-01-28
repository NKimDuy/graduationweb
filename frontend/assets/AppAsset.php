<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
		'css/my-css.css',
        'css/site.css',
		'css/tooltipster/tooltipster.bundle.min.css',
		'css/tooltipster/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css',
		'https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css',
    ];
    public $js = [
		'js/tooltipster/tooltipster.bundle.min.js',
		'https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js',
		'js/check-semester.js',
		
		
		
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
		'yii\jui\JuiAsset',
    ];
}
