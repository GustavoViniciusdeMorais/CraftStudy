<?php

namespace gustavomorais\craftscitext;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use gustavomorais\craftscitext\models\Settings;
use craft\web\UrlManager;
use yii\base\Event;
use craft\events\RegisterUrlRulesEvent;
use craft\events\RegisterCpNavItemsEvent;
use craft\web\twig\variables\Cp;

/**
 * SciText plugin
 *
 * @method static SciText getInstance()
 * @method Settings getSettings()
 */
class SciText extends Plugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
        ];
    }

    public function init(): void
    {
        parent::init();

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
        return Craft::$app->view->renderTemplate('_scitext/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
        // Register event handlers here ...
        // (see https://craftcms.com/docs/4.x/extend/events.html to get started)
        Event::on(
            UrlManager::class,
            UrlManager::EVENT_REGISTER_CP_URL_RULES,
            function (RegisterUrlRulesEvent $event) {
                $event->rules['scitext'] = $this->id . '/main/main-screen';
                $event->rules['scitext/get-entries'] = $this->id . '/main/get-entries';
                $event->rules['scitext/get-entry-fields'] = $this->id . '/main/get-entry-fields';
                $event->rules['scitext/get-entry-field-text'] = $this->id . '/main/get-entry-field-text';
                $event->rules['scitext/overwrite-entry-field'] = $this->id . '/main/overwrite-entry-field';
            }
        );

        Event::on(
            Cp::class,
            Cp::EVENT_REGISTER_CP_NAV_ITEMS,
            function(RegisterCpNavItemsEvent $event) {
                $event->navItems[] = [
                    'url' => 'scitext',
                    'label' => 'Morais SciText',
                    'icon' => '@mynamespace/path/to/icon.svg',
                ];
            }
        );
    }
}
