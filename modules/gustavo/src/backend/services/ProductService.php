<?php

namespace modules\gustavo\backend\services;

use DateTime;
use modules\gustavo\backend\models\Product;

class ProductService
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function createProduct($data)
    {
        $this->product->name = $data->name;
        $this->product->price = $data->price;
        $this->product->save();
        return true;
    }

    public function getProducts()
    {
        return $this->product->find()->all();
    }
}
