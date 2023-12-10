<?php

namespace gustavomorais\craftscitext\controllers;

use Craft;
use craft\web\Controller;
use gustavomorais\craftscitext\assetbundles\ScriptsBundle;
use gustavomorais\craftscitext\services\SectionService;
use craft\elements\Entry;

class MainController extends Controller
{
    protected array|bool|int $allowAnonymous = true;
    public $enableCsrfValidation = false;
    
    public function actionMainScreen()
    {
        $section = new SectionService();

        $sectionsList = $section->all();

        $this->view->registerAssetBundle(
            ScriptsBundle::class
        );

        return $this->renderTemplate(
            '_scitext/main',
            [
                'sectionsList' => $sectionsList,
            ]
        );
    }

    public function actionGetEntries()
    {
        print_r(json_encode(['actionGetEntries']));echo "\n\n";exit;
    }
}
