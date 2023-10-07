<?php

namespace gustavomorais\craftexporter\services;

use gustavomorais\craftexporter\infrastructure\repositories\RSection;
use Craft;

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
}
