<?php

namespace modules\gustavo;

use Craft;
use craft\events\RegisterCpNavItemsEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\web\twig\variables\Cp;
use craft\web\UrlManager;
use yii\base\Event;

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
            $this->controllerNamespace = 'modules\\gustavo\\frontend\\controllers';
        }
        parent::init();

        /**
         * Link a dashboard link to a yii action
         */
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['gustavomp'] = $this->id . '/gustavo/test-gustavo';
                $event->rules['gustavomp/view'] = $this->id. '/gustavo/test-view';
            }
        );

        /**
         * Builds dashboard link
         */
        Event::on(
            Cp::class,
            CP::EVENT_REGISTER_CP_NAV_ITEMS,
            function (RegisterCpNavItemsEvent $event) {
                $event->navItems[] = [
                    'url' => 'gustavomp',
                    'label' => 'Gustavo Modulo'
                ];
            }
        );
    }
}