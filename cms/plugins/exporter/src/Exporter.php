<?php

namespace gustavomorais\craftexporter;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use gustavomorais\craftexporter\models\Settings;
use craft\web\UrlManager;
use yii\base\Event;
use craft\events\RegisterUrlRulesEvent;
use craft\events\RegisterCpNavItemsEvent;
use craft\web\twig\variables\Cp;

/**
 * Exporter plugin
 *
 * @method static Exporter getInstance()
 * @method Settings getSettings()
 */
class Exporter extends Plugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
            'aliases' => [
                '@mynamespace' => 'gustavomorais\\craftexporter',
                '@resources' => 'src/resources'
            ]
        ];
    }

    public function init(): void
    {
        parent::init();
        // print_r(json_encode(['test']));echo "\n\n";exit;
        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('_exporter/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
        /**
         * Link a dashboard link to a yii action
         */
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['craftexportentries'] = $this->id . '/main/main-screen';
                $event->rules['vikiport/get-entries'] = $this->id . '/main/get-entries';
            }
        );

        Event::on(
            Cp::class,
            Cp::EVENT_REGISTER_CP_NAV_ITEMS,
            function(RegisterCpNavItemsEvent $event) {
                $event->navItems[] = [
                    'url' => 'craftexportentries',
                    'label' => 'Gus Exporter',
                    'icon' => '@mynamespace/path/to/icon.svg',
                ];
            }
        );
    }
}
