<?php

namespace modules\gustavo\frontend\controllers;

use craft\web\Controller;

class GustavoController extends Controller
{
    // public function getViewPath()
    // {
    //     return '/modules/gustavo/src/frontend/templates';
    // }

    public function actionTestGustavo()
    {
        print_r(json_encode("test"));exit;
    }

    public function actionTestView()
    {
        // return 'view';
        return $this->renderTemplate('gustavo/index.twig');
    }
}
