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
                    $sField->createField($name, 'text');
                }
                // print_r(json_encode([$sectionData['formattedData']]));echo "\n\n";exit;
                // foreach($sectionData['formattedData'] as $data) {
                //     // print_r(json_encode([$data['title']]));echo "\n\n";exit;
                //     $entry = new Entry();
                //     $entry->sectionId = 7;
                //     $entry->typeId = 7;
                //     $entry->authorId = 1;
                //     $entry->enabled = true;
                //     $entry->title = $data['title'];
                //     $entry->setFieldValues([
                //         'field1' => $data['title'],
                //         'field2' => $data['title'],
                //     ]);
                //     $success = Craft::$app->elements->saveElement($entry);
                //     if (!$success) {
                //         Craft::error('Couldn’t save the entry "'.$entry->title.'"', __METHOD__);
                //     }
                // }
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
