<?php
namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $this->view->title = "Index";

        $this->view->registerMetaTag([
            'name' => 'description',
            'content' => 'index description'
        ]);
        $this->view->registerMetaTag([
            'name' => 'keywords',
            'content' => 'index keywords'
        ]);
        
        return $this->render("index");
    }
}