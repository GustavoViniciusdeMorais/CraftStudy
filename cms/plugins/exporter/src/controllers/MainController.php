<?php

namespace gustavomorais\craftexporter\controllers;

use craft\web\Controller;
use gustavomorais\craftexporter\services\SSection;
use gustavomorais\craftexporter\assetbundles\ScriptsBundle;

class MainController extends Controller
{
    protected array|bool|int $allowAnonymous = true;

    public function actionEcho()
    {
        $sSection = new SSection();
        $sectionsList = $sSection->getAllSections();
        
        $this->view->registerAssetBundle(
            ScriptsBundle::class
        );

        return $this->renderTemplate(
            '_exporter/main',
            [
                'sections' => $sectionsList
            ]
        );
    }
}
