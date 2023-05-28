<?php

namespace modules\gustavo\frontend\console;

use Craft;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use modules\gustavo\backend\migrations\ProductMigration;

class ProductController extends Controller
{
    # class command: php craft gustavo/product/build

    public function actionBuild()
    {
        $productMigration = new ProductMigration();
        $productMigration->createTable(
            'products',
            [
                'id' => 'integer',
                'name' => 'string',
                'price' => 'numeric'
            ]
        );
        $productMigration->addPrimaryKey('products_pk', 'products', 'id');
        print_r(json_encode(['test']));echo "\n\n";exit;
    }
}
