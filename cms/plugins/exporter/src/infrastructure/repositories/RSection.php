<?php

namespace gustavomorais\craftexporter\infrastructure\repositories;

use gustavomorais\craftexporter\domain\repositories\ISection;
use craft\services\Sections;
use craft\models\Section;

class RSection implements ISection
{
    protected $sections;

    public function __construct()
    {
        $this->sections = new Sections();
    }

    public function all()
    {
        return $this->sections->getAllSections();
    }

    public function findByName(string $name = '')
    {
        return $this->sections->getSectionByHandle($name);
    }

    public function createSection(
        array $attributes = [],
        string $handle = '',
        string $name = '',
    ) {
        if (
            !empty($attributes)
            && !empty($handle)
            && !empty($name)
        ) {
            $section = new Section();
            $section->name = $name;
            $section->handle = $handle;
            $section->attributes = $attributes;
            $this->sections->saveSection($section);
            return $section;
        }
        return false;
    }
}
