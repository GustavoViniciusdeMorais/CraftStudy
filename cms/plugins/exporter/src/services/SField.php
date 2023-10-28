<?php

namespace gustavomorais\craftexporter\services;

use craft\services\Fields;

class SField
{
    public function createField(string $name, string $type)
    {
        $fields = new Fields();
        if (
            !empty($name)
            && !empty($type)
        ) {
            $resultedField = $fields->createField([
                'name' => $name,
                'type' => $type,
            ]);
            $resultedField = $fields->saveField($resultedField);
            throw new \Exception($resultedField);
        }
    }
}
