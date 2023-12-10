<?php

namespace gustavomorais\craftscitext\services;

use craft\services\Sections;

class SectionService
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
}
