<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/vspacing.min.css',
        'css/font-awesome.min.css',
        'css/simple-line-icons.css',
        'css/style.css',
        'css/colors/green2.css',
        'css/templ.css',
    ];
    public $js = [
        /*'js/modernizr.js',
        'js/smoothscroll.js',
        'js/jquery.nicescroll.min.js',
        //menu
        'js/jquery.hoverIntent.min.js',
        'js/waypoints.min.js',
        'js/waypoints-sticky.min.js',

        //'js/jquery.debouncedresize.js',
        //'js/retina.min.js',
        'js/owl.carousel.min.js',
        'js/skrollr.min.js',
        //'js/jquery.countTo.min.js',
        //'js/isotope.pkgd.min.js',
        'js/jquery.magnific-popup.min.js',
        //'js/jquery.themepunch.tools.min.js',
        //'js/jquery.themepunch.revolution.min.js',
        //'js/wow.min.js',
        //item
        //'js/jquery.selectbox.min.js',
        'js/jquery.elevateZoom.min.js',
        'js/jquery.bootstrap-touchspin.min.js',
        //--

        'js/main.min.js',
        //'js/main.js',

        //'//api-maps.yandex.ru/2.1/?lang=ru_RU',*/
        //'//vk.com/js/api/openapi.js?146',
        //'js/vk.js',
        //'js/clr_site.min.js',
        //'js/lightbox.js',
        //'js/common.js',
        'js/lightbox.min.js',
        'js/common.min.js',
        //'js/common_over.js',
        //'js/calculator_site.js',
        //'js/lightbox_over.js',
    ];
    public $depends = [
        'yii\web\YiiAsset', // yii.js, jquery.js
        'yii\bootstrap\BootstrapAsset', // bootstrap.css
        'yii\bootstrap\BootstrapPluginAsset', // bootstrap.js
    ];
    public $jsOptions = [
        'position' =>  View::POS_END,
    ];
    
}
