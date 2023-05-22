<?php

namespace modules\gustavo\controllers;

use craft\web\Controller;

class GustavoController extends Controller
{
    public function testAction()
    {
        print_r(json_encode("test"));exit;
    }
}
