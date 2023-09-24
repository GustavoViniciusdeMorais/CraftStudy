<?php

namespace gustavomorais\craftexporter\controllers;

use craft\web\Controller;

class MainController extends Controller
{
    public function actionTest()
    {
        print_r(json_encode(['test']));echo "\n\n";exit;
    }
}
