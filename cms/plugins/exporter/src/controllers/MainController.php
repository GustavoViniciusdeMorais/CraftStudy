<?php

namespace gustavomorais\craftexporter\controllers;

use craft\web\Controller;

class MainController extends Controller
{
    protected array|bool|int $allowAnonymous = true;

    public function actionEcho()
    {
        // return $this->asJson(['ping' => 'Pong!']);
        return $this->renderTemplate('_exporter/main');
    }
}
