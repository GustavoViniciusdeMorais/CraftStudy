<?php

namespace gustavomorais\craftexporter\domain\repositories;

interface ISection
{
    public function all();
    public function findByName(string $name = '');
}
