<?php

namespace gustavomorais\craftexporter\infrastructure\repositories;

use gustavomorais\craftexporter\domain\repositories\ISection;
use craft\services\Sections;

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
}
