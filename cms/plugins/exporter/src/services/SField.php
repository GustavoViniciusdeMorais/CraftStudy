<?php

namespace gustavomorais\craftexporter\services;

use Craft;
use craft\services\Fields;
use craft\models\CategoryGroup;
use craft\services\Sections;
use craft\models\FieldLayout;

class SField
{
    public function createField(string $name, string $type)
    {
        $fields = new Fields();
        if (
            !empty($name)
            && !empty($type)
        ) {
            // $resultedField = $fields->createField([
            //     'name' => $name,
            //     'type' => $type,
            // ]);
            // $fieldsService = Craft::$app->getFields();
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
            $result = $fields->saveField($field, false);
            print_r(json_encode([$result]));echo "\n\n";
            // $fLayout = new FieldLayout();
            // $fLayout->setFields([$resultedField]);

            // $resultedField = $fields->saveLayout($fLayout);
            // throw new \Exception($resultedField);
        }
    }

    public function createCategory()
    {
        $categoryGroup = new CategoryGroup();
        $categoryGroup->name = 'test1';
        $categoryGroup->handle = 'test1';
    }

    public function createFieldLayout()
    {
        $section = new Sections();
        $entryType = $section->getSectionByHandle('entriesGus')->entryTypes[0];
        // $entryType = Craft::$app->getSections()->getSectionByHandle('entriesGus')->entryTypes[0];
        print_r(json_encode(['asfasdfadfs' => $entryType]));echo "\n\n";
    }
}
