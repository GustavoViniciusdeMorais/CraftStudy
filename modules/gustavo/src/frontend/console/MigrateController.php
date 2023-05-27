<?php

namespace modules\gustavo\frontend\console;

use Craft;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class MigrateController extends Controller
{
    # command: php craft gustavo/migrate/section --section-handle=blog
    
    // Properties
    // =========================================================================

    public string $sectionHandle = '';


    // Public Methods
    // =========================================================================

    public function options($actionID): array
    {
        $options = parent::options($actionID);

        // For each `actionID`, add options to the console command
        if ($actionID === 'section') {
            $options[] = 'sectionHandle';
        }

        return $options;
    }


    // Public Methods
    // =========================================================================

    public function actionSection(): int
    {
        if (!$this->sectionHandle) {
            $this->stderr('You must provide a --section-handle option.' . PHP_EOL, Console::FG_RED);

            return ExitCode::UNSPECIFIED_ERROR;
        }

        $this->stdout("Starting migration for {$this->sectionHandle} ..." . PHP_EOL, Console::FG_YELLOW);

        // ... add your migration logic

        $this->stdout("Finished migration for {$this->sectionHandle} ..." . PHP_EOL, Console::FG_GREEN);

        return ExitCode::OK;
    }
}
