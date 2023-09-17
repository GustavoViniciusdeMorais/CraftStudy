<?php

namespace modules\craftexportentries;

use craft\base\Plugin;
use Craft;
use craft\events\RegisterCpNavItemsEvent;
use craft\events\RegisterUrlRulesEvent;
use craft\web\twig\variables\Cp;
use craft\web\UrlManager;
use yii\base\Event;
use craft\events\RegisterTemplateRootsEvent;
use craft\web\View;

class CraftExportEntries extends Plugin
{
    public function init()
    {
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\\craftexportentries\\adapters\\ui\\console';
        } else {
            $this->controllerNamespace = 'modules\\craftexportentries\\adapters\\ui\\controllers';
        }
        parent::init();

        /**
         * Link a dashboard link to a yii action
         */
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['craftexportentries'] = $this->id . '/main/main-screen';
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
                    'url' => 'craftexportentries',
                    'label' => 'Export Inport'
                ];
            }
        );

        // Event::on(
        //     View::class,
        //     View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
        //     function(RegisterTemplateRootsEvent $event) {
        //         $event->roots['craftexportentries'] = __DIR__ . '/adapters/ui/templates';
        //     }
        // );

        // Register template roots to resolve our templates correctly
        Event::on(View::class, View::EVENT_REGISTER_CP_TEMPLATE_ROOTS, function(RegisterTemplateRootsEvent $event) {
            $event->roots[$this->id] = $this->getBasePath() . DIRECTORY_SEPARATOR . 'adapters/ui/templates';
            // print_r(json_encode([$event]));echo "\n\n";exit;
        });

        // Register the custom template path
        // Event::on(
        //     \craft\web\View::class,
        //     \craft\web\View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
        //     function (Event $event) {
        //         $event->sender->setTemplatesPath('craftexportentries/src/adapters/ui/templates');
        //         print_r(json_encode([$event]));echo "\n\n";exit;
        //     }
        // );
        // print_r(json_encode([
        //     $this->id,
        //     __DIR__
        // ]));echo "\n\n";exit;
        // Event::on(
        //     View::class,
        //     View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
        //     function(RegisterTemplateRootsEvent $event) {
        //         $event->roots['craftexportentries'] = __DIR__ . '/adapters/ui/templates';
        //     }
        // );
        // Event::on(
        //     View::class,
        //     View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
        //     function (RegisterTemplateRootsEvent $e) {
        //         $e->roots[$this->id] = __DIR__ . '/adapters/ui/templates';
        //         // print_r(json_encode([$e->roots[$this->id]]));echo "\n\n";exit;
        //     }
        // );
    }
}
