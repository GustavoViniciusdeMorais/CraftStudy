<?php

namespace gustavomorais\craftexporter\controllers;

use Craft;
use craft\web\Controller;
use gustavomorais\craftexporter\services\SSection;
use gustavomorais\craftexporter\assetbundles\ScriptsBundle;
use gustavomorais\craftexporter\services\ImportData;

class MainController extends Controller
{
    protected array|bool|int $allowAnonymous = true;
    public $enableCsrfValidation = false;

    public function actionMainScreen()
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

    public function actionGetEntries()
    {
        $sessionHandler = Craft::$app->request->post('sessionHandler');
        return "you sent this: {$sessionHandler}";
    }

    public function actionImportEntries()
    {
        try {
            $result = [];
            $sectionData = (new ImportData)->execute();
            if (
                !empty($sectionData)
                && isset($sectionData['attributes'])
                && isset($sectionData['fileName'])
            ) {
                $sSection = new SSection();
                $result['section'] = $sSection->createSection(
                    $sectionData['fileName'],
                    $sectionData['fileName'],
                    $sectionData['attributes']
                );
                $result['status'] = 'success';
            }

            return $this->asJson($result);
        } catch (\Exception $e) {
            return $this->asJson([
                'message' => $e->getMessage()
            ]);
        }
    }
}
