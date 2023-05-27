<?php

namespace modules\gustavo\backend\services;

use modules\gustavo\backend\models\MyEntries;

class MyEntriesService
{
    protected $myEntries;

    public function __construct()
    {
        $this->myEntries = new MyEntries();
    }

    public function getMyEntries()
    {
        $rsult = $this->myEntries->find()
        ->where(['id' => 2])
        ->one();
        return json_encode(['data' => $rsult->postDate]);
    }
}
