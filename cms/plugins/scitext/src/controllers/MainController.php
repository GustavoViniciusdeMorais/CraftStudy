<?php

namespace gustavomorais\craftscitext\controllers;

use Craft;
use craft\web\Controller;
use gustavomorais\craftscitext\assetbundles\ScriptsBundle;
use gustavomorais\craftscitext\services\SectionService;

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
        $result = [];
        $htmlEntries = "<option value=''>Choose entry</option>";
        try {
            $post = Craft::$app->getRequest()->post();
            if (
                !empty($post)
                && isset($post['sessionHandler'])
            ) {
                $section = new SectionService();
                $entries = $section->getEntries($post['sessionHandler']);
                if (!empty($entries)) {
                    foreach ($entries as $entry) {
                        $htmlEntries .= "<option value='{$entry->id}'>{$entry->title}</option>";
                    }
                }
            }
            $result['htmlEntries'] = $htmlEntries;
        } catch (\Exception $e) {
            Craft::error([
                'type' => 'chamados-zendesk-senat',
                'message' => "{$e->getMessage()}",
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'details' => $e->getTrace(),
            ]);
        }
        return $this->asJson($result);
    }

    public function actionGetEntryFields()
    {
        $result = [];
        $htmlFields = "<option value=''>Choose text field</option>";
        try {
            $post = Craft::$app->getRequest()->post();
            if (
                !empty($post)
                && isset($post['entryId'])
            ) {
                $section = new SectionService();
                $fields = $section->getEntryFields($post['entryId']);
                if (!empty($fields)) {
                    foreach ($fields as $field) {
                        $htmlFields .= "<option value='{$field['handle']}'>{$field['name']}</option>";
                    }
                }
            }
            $result['htmlFields'] = $htmlFields;
        } catch (\Exception $e) {
            Craft::error([
                'type' => 'chamados-zendesk-senat',
                'message' => "{$e->getMessage()}",
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'details' => $e->getTrace(),
            ]);
        }
        return $this->asJson($result);
    }

    public function actionGetEntryFieldText()
    {
        $result = [];
        try {
            $post = Craft::$app->getRequest()->post();
            if (
                !empty($post)
                && isset($post['entryId'])
                && isset($post['fieldHandle'])
            ) {
                $section = new SectionService();
                $content = $section->getEntryFieldText($post['entryId'], $post['fieldHandle']);

            }
            $result['data'] = $content;
        } catch (\Exception $e) {
            Craft::error([
                'type' => 'chamados-zendesk-senat',
                'message' => "{$e->getMessage()}",
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'details' => $e->getTrace(),
            ]);
        }
        return $this->asJson($result);
    }

    public function actionOverwriteEntryField()
    {
        $result = [];
        try {
            $post = Craft::$app->getRequest()->post();
            if (
                !empty($post)
                && isset($post['entryId'])
                && isset($post['fieldHandle'])
                && isset($post['newValue'])
            ) {
                $section = new SectionService();
                $response = $section->overwriteEntryField(
                    $post['entryId'],
                    $post['fieldHandle'],
                    $post['newValue']
                );
            }
            $result['data'] = $response;
        } catch (\Exception $e) {
            Craft::error([
                'type' => 'chamados-zendesk-senat',
                'message' => "{$e->getMessage()}",
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'details' => $e->getTrace(),
            ]);
        }
        return $this->asJson($result);
    }
}
