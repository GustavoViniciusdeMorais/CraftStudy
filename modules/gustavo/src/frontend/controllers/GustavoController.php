<?php

namespace modules\gustavo\frontend\controllers;

use craft\web\Controller;
use modules\gustavo\backend\services\MyEntriesService;

class GustavoController extends Controller
{
    protected $allowAnonymous = ['get-data'];


    public function actionTestGustavo()
    {
        print_r(json_encode("test"));exit;
    }

    public function actionTestView()
    {
        // return 'view';
        return $this->renderTemplate('gustavo/index.twig');
    }

    public function actionGetData()
    {
        $service = new MyEntriesService();
        return $service->getMyEntries();
        // return json_encode('data');
    }
}
