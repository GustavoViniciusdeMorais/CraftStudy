<?php

namespace gustavomorais\craftscitext\services;

use Craft;
use craft\elements\Entry;
use craft\records\Field;
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

    public function getEntries($sectionName = false)
    {
        $entries = [];
        if ($sectionName) {
            $entries = Entry::find()->section($sectionName)->all();
        }
        return $entries;
    }

    public function getEntryFields($entryId = false)
    {
        $fields = [];
        if ($entryId) {
            $entry = Entry::find()->id($entryId)->one();
            if (!empty($entry)) {
                $fields = $this->filterFieldTypeText($entry->fields());
            }
        }
        return $fields;
    }

    public function filterFieldTypeText($fields)
    {
        $textFields = [];
        if (!empty($fields)) {
            foreach ($fields as $handler => $object) {
                if (is_string($handler)) {
                    $field = Field::find()->where(['name' => $handler])->one();
                    if (
                        !empty($field)
                        && isset($field->type)
                        && $field->type = "craft\\fields\\PlainText"
                    ) {
                        $textFields[] = [
                            'name' => $field->name,
                            'handle' => $field->handle
                        ];
                    }
                }
                
            }
        }
        return $textFields;
    }

    public function getEntryFieldText($entryId = false, $fieldHandle = false)
    {
        $result = '';
        if (
            $entryId
            && $fieldHandle
        ) {
            $entry = Entry::find()->id($entryId)->one();
            $result = $entry->$fieldHandle;
        }
        return $result;
    }

    public function overwriteEntryField
    (
        $entryId = false,
        $fieldHandle = false,
        $newValue = false
    ) {
        $result = 'Error: Some error occurred. No changes applied.';
        if (
            $entryId
            && $fieldHandle
            && $newValue
        ) {
            $entry = Entry::findOne($entryId);
            $entry->setFieldValues([
                $fieldHandle => $newValue
            ]);
            if (Craft::$app->elements->saveElement($entry)) {
                $result = 'Success: Summary saved with success!';
            }
        }
        return "<strong>{$result}</strong>";
    }
}
