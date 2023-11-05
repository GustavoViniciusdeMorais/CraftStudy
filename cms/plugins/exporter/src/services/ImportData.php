<?php

namespace gustavomorais\craftexporter\services;

use Craft;
use craft\web\UploadedFile;
use gustavomorais\craftexporter\infrastructure\repositories\RSection;

class ImportData
{
    public function execute()
    {
        $result = [];
        $file = (new UploadedFile)->getInstanceByName('entriesData');

        if (
            !empty($file)
            && isset($file->baseName)
        ) {
            $formattedResult = $this->formatCsvData($file);
            $result['formattedData'] = $formattedResult['formattedData'];
            $result['attributes'] = $formattedResult['attributes'];
            $result['fileName'] = $file->baseName;
        }

        return $result;
        // $content = file_get_contents($file->tempName);
        // $content = file_get_contents('/var/www/html/cms/plugins/exporter/src/csvs/entries.csv');
        // $arrayContent = str_getcsv($content);
        // print_r(json_encode([$formattedData]));echo "\n\n";exit;
    }

    /**
     * Returns and array where the first row
     * is the columns, and the following rows
     * are the contents.
     * CSV separator must be a comma.
     * @return array $formattedData
     */
    public function formatCsvData($file)
    {
        $formattedData = [];
        $attributes = [];
        $row = 1;
        if (
            isset($file)
            && !empty($file)
            && isset($file->tempName)
            && !empty($file->tempName)
            && ($handle = fopen($file->tempName, "r")) !== false
        ) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($row == 1) {
                    $attributes = $data;
                    ++$row;
                } else {
                    $formattedData[] = $this->formatEntryData($attributes, $data);
                }
            }
            fclose($handle);
        }

        return [
            'formattedData' => $formattedData,
            'attributes' => $attributes
        ];
    }

    public function formatEntryData($attributes, $data)
    {
        $entry = [];
        if (!empty($attributes) && !empty($data)) {
            foreach ($attributes as $key => $value) {
                $entry[$value] = $data[$key];
            }
        }
        return $entry;
    }
}