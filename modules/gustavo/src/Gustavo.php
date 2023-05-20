<?php

namespace modules\gustavo;

use Craft;

/**
 * Custom module class.
 *
 * This class will be available throughout the system via:
 * `Craft::$app->getModule('my-module')`.
 *
 * You can change its module ID ("my-module") to something else from
 * config/app.php.
 *
 * If you want the module to get loaded on every request, uncomment this line
 * in config/app.php:
 *
 *     'bootstrap' => ['my-module']
 *
 * Learn more about Yii module development in Yii's documentation:
 * http://www.yiiframework.com/doc-2.0/guide-structure-modules.html
 **/
class Gustavo extends \yii\base\Module
{
    /**
     * Gustavo
     */
    public function init()
    {
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\\gustavo\\frontend\\console';
        } else {
            $this->controllerNamespace = 'modules\\gustavo\\frontend';
        }
        parent::init();
    }
}