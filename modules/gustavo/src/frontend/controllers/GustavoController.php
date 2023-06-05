<?php

namespace modules\gustavo\frontend\controllers;

use Craft;
use craft\web\Controller;
use modules\gustavo\backend\services\ProductService;
use craft\mail\Message;

class GustavoController extends Controller
{
    protected $allowAnonymous = ['get-data'];
    protected $productService;

    public function actionTestWork()
    {
        print_r(json_encode("work work"));exit;
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

    public function actionSendEmail()
    {
        $mailer = Craft::$app->getMailer();
        // print_r(json_encode(['mailer'=>$mailer]));echo "\n\n";exit;
        
        $message = new Message();
        $message->setFrom('admin@email.com');
        $message->setSubject('admin@email.com');
        $message->setHtmlBody(\Craft::$app->view->renderTemplate('gustavo/email'));
        $message->setTo('admin@email.com');
        $result = $mailer->send($message);

        print_r(json_encode(['result '=>$result]));echo "\n\n";exit;
    }
}
