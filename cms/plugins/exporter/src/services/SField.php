<?php

namespace gustavomorais\craftexporter\services;

use Craft;
use craft\services\Fields;
use craft\models\CategoryGroup;
use craft\services\Sections;
use craft\models\FieldLayout;
use craft\helpers\ArrayHelper;

class SField
{
    public function createField(string $name, string $type, string $sectionHandle)
    {
        $fields = new Fields();
        if (
            !empty($name)
            && !empty($type)
        ) {
            $field = $fields->createField([
                'type' => 'craft\fields\PlainText',
                'groupId' => 1,
                'name' => $name,
                'handle' => $name,
                'instructions' => '',
                'translationMethod' => 'none',
                'translationKeyFormat' => NULL,
                'settings' => [
                    'placeholder' => 'Type here',
                    'charLimit' => '',
                    'multiline' => '',
                    'initialRows' => '4',
                    'columnType' => 'text',
                ],
            ]);
            $fields->saveField($field, false);
            // $this->addFieldToSection($sectionHandle, $field);
        }
        return true;
    }

    public function addFieldToSection(string $sectionHandle, $field = null)
    {
        if (
            !empty($sectionHandle)
            && !empty($field)
        ) {
            // Get the entry type to add the new field to
            $entryType = Craft::$app->getSections()->getSectionByHandle($sectionHandle)->entryTypes[0];

            // Get current fieldLayout
            $fieldLayout = $entryType->getFieldLayout();

            $amendedFields = ArrayHelper::merge([$field], $fieldLayout->getFields());
            $fieldLayout->setFields($amendedFields);
            $fieldLayout->getTabs()[0]->setFields($amendedFields);
                        
            // Change entryType fieldLayout
            $entryType->setFieldLayout($fieldLayout);

            // Save entryType configuration
            Craft::$app->getSections()->saveEntryType($entryType);
        }
    }
}
