<?php

namespace modules\craftexportentries\adapters\ui\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use modules\craftexportentries\adapters\percistence\repositories\SectionRepository;

class MainController extends Controller
{
    public function actionMainScreen()
    {
        $sectionRepository = new SectionRepository;
        $sectionsList = $sectionRepository->all();

        $this->renderTemplate('main.html');

        // print_r(json_encode(['sections' => $sectionsList]));echo "\n\n";exit;
        // print_r(json_encode(['inside controller']));echo "\n\n";exit;
        // return Craft::$app->view->renderTemplate("main.html");
        // $oldMode = Craft::$app->view->getTemplateMode();
        // Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);
        // $html = Craft::$app->view->renderTemplate('craftexportentries/src/adapters/ui/templates/main.html');
        // Craft::$app->view->setTemplateMode($oldMode);
        // return $html;
        // return $this->renderTemplate('craftexportentries/src/adapters/ui/templates/main.html', []);


        // $view = Craft::$app->getView();
        // $oldTemplatesPath = $view->getTemplatesPath();

        // $view->setTemplatesPath(Plugin::getInstance()->getBasePath());
        // $html = $view->renderTemplate('/bar');

        // $view->setTemplatesPath($oldTemplatesPath);

        // return $html;
    }
}
