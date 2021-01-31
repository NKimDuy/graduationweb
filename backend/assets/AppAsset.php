<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
		'css/fonts/circular-std/style.css',
		'css/style.css',
		'css/fonts/fontawesome/css/fontawesome-all.css',
		'https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css',
		'css/tooltipster/tooltipster.bundle.min.css',
		'css/tooltipster/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css',
    ];
    public $js = [
		'js/upload.js',
		'js/check-semester.js',
		'js/delete-button-create-js.js',
		'js/sheetjs/dist/xlsx.full.min.js',
		'https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js',
		'js/tooltipster/tooltipster.bundle.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
		'yii\jui\JuiAsset',
    ];
}
