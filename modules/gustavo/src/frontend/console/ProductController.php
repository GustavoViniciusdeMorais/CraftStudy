<?php

namespace modules\gustavo\frontend\console;

use Craft;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;
use modules\gustavo\backend\migrations\ProductMigration;

class ProductController extends Controller
{
    # class commands:
    # php craft gustavo/product/build
    # php craft gustavo/product/destroy

    public function actionBuild()
    {
        $productMigration = new ProductMigration();
        $productMigration->createTable(
            'products',
            [
                'id' => 'integer unsigned NOT NULL AUTO_INCREMENT',
                'name' => 'string',
                'price' => 'numeric',
                'dateCreated' => 'datetime',
                'dateUpdated' => 'datetime',
                'uid' => 'string',
                "PRIMARY KEY (`id`)",
            ]
        );
    }

    public function actionDestroy()
    {
        $productMigration = new ProductMigration();
        $productMigration->dropTable('products');
    }
}
