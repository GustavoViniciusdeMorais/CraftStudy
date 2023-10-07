<?php

namespace gustavomorais\craftexporter\controllers;

use craft\web\Controller;
use gustavomorais\craftexporter\services\SSection;

class MainController extends Controller
{
    protected array|bool|int $allowAnonymous = true;

    public function actionEcho()
    {
        $sSection = new SSection();
        $sectionsList = $sSection->getAllSections();
        
        return $this->renderTemplate(
            '_exporter/main',
            [
                'sections' => $sectionsList
            ]
        );
    }
}
