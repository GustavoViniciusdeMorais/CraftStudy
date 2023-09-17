<?php

namespace modules\craftexportentries\adapters\percistence\repositories;

use modules\craftexportentries\ports\output\repositories\SectionRepository as SectionPort;
use craft\services\Sections;

class SectionRepository implements SectionPort
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
