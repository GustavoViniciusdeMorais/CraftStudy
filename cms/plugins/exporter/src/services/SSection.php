<?php

namespace gustavomorais\craftexporter\services;

use gustavomorais\craftexporter\infrastructure\repositories\RSection;
use Craft;
use craft\models\Section;
use craft\models\Section_SiteSettings;

class SSection
{
    protected $rSection;

    public function __construct()
    {
        $this->rSection = new RSection();
    }

    public function getAllSections()
    {
        $sectionsNames = [];
        try {
            $sections = $this->rSection->all();
            
            if (!empty($sections)) {
                foreach($sections as $section) {
                    $sectionsNames[] = [
                        'id' => $section->id,
                        'name' => $section->name,
                        'handle' => $section->handle,
                    ];
                }
            }
        } catch (\Exception $e) {
            Craft::error(
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'details' => $e->getTrace(),
                ]
            );
        }
        return $sectionsNames;
    }

    public function createSection(
        string $name = 'default',
        string $handle = 'default'
    ) {
        $result = [];
        try {
            $section = new Section([
                'name' => $name,
                'handle' => $handle,
                'type' => Section::TYPE_CHANNEL,
                'attributes' => [],
                'siteSettings' => [
                    new Section_SiteSettings([
                        'siteId' => Craft::$app->sites->getPrimarySite()->id,
                        'enabledByDefault' => true,
                        'hasUrls' => true,
                        'uriFormat' => 'foo/{slug}',
                        'template' => 'foo/_entry',
                    ]),
                ]
            ]);
            $result['section'] = Craft::$app->sections->saveSection($section);
            $result['status'] = 'success';
        } catch (\Exception $e) {
            $result['status'] = 'error';
            $result['message'] = $e->getMessage();
            $result['file'] = $e->getFile();
            $result['line'] = $e->getLine();
            $result['trace'] = $e->getTrace();
        }
        return $result;
    }
}
