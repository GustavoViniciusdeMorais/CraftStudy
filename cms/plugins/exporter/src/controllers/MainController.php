<?php

namespace gustavomorais\craftexporter\controllers;

use Craft;
use craft\web\Controller;
use gustavomorais\craftexporter\services\SSection;
use gustavomorais\craftexporter\assetbundles\ScriptsBundle;
use gustavomorais\craftexporter\services\ImportData;
use gustavomorais\craftexporter\services\SField;
use craft\elements\Entry;

class MainController extends Controller
{
    protected array|bool|int $allowAnonymous = true;
    public $enableCsrfValidation = false;

    public function actionMainScreen(string $message = '')
    {
        $sSection = new SSection();
        $sectionsList = $sSection->getAllSections();
        
        $this->view->registerAssetBundle(
            ScriptsBundle::class
        );

        return $this->renderTemplate(
            '_exporter/main',
            [
                'sections' => $sectionsList,
                'message' => $message,
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
        $result = [];
        try {
            $sectionData = (new ImportData)->execute();
            if (
                !empty($sectionData)
                && isset($sectionData['attributes'])
                && isset($sectionData['fileName'])
            ) {
                $sSection = new SSection();
                $resultedSection = $sSection->createSection(
                    $sectionData['fileName'],
                    $sectionData['fileName'],
                    $sectionData['attributes']
                );

                if ($resultedSection['status'] == 'error') {
                    throw new \Exception("Error creating section");
                }

                $result['status'] = 'success';
                $result['section'] = $resultedSection['section'];

                $sField = new SField();
                foreach ($sectionData['attributes'] as $name) {
                    $sField->createField($name, 'text', $sectionData['fileName']);
                }
            }
        } catch (\Exception $e) {
            $result = [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace(),
            ];
        }

        if (is_array($result)) {
            $result = json_encode($result);
        }

        return $this->actionMainScreen($result);
    }
}
