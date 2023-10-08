<?php

namespace gustavomorais\craftexporter\assetbundles;

use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

class ScriptsBundle extends AssetBundle
{
    public function init()
    {
        // define the path that your publishable resources live
        $this->sourcePath = '/var/www/html/cms/plugins/exporter/src/resources';

        // define the dependencies
        $this->depends = [
            CpAsset::class,
        ];

        // define the relative path to CSS/JS files that should be registered with the page
        // when this asset bundle is registered
        $this->js = [
            'scripts.js',
        ];

        $this->css = [
            'styles.css',
        ];

        parent::init();
    }
}
