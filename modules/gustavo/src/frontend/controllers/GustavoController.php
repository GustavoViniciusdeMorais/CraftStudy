<?php

namespace modules\gustavo\frontend\controllers;

use Craft;
use craft\web\Controller;
use modules\gustavo\backend\services\ProductService;

class GustavoController extends Controller
{
    protected $allowAnonymous = ['get-data'];
    protected $productService;

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
        // $service = new MyEntriesService();
        // return $service->getMyEntries();
        return json_encode('data');
    }
    
    public function actionCreateForm()
    {
        return $this->renderTemplate('gustavo/createProduct.twig');
    }

    public function actionRceiveProductData()
    {
        $this->requirePostRequest();

        // get the request
        $request = Craft::$app->getRequest();
        $data = new \StdCLass();
        $data->name = $request->getBodyParam('name');
        $data->price = $request->getBodyParam('price');

        $this->productService = new ProductService();

        $result = $this->productService->createProduct($data);

        if ($result) {
            return $this->actionListProducts();
        }

        print_r(json_encode([$data]));echo "\n\n";exit;
    }

    public function actionListProducts()
    {
        $this->productService = new ProductService();
        $products = $this->productService->getProducts();
        return $this->renderTemplate('gustavo/listProducts.twig', ['products' => $products]);
    }
}
