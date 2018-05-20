<?php
namespace backend\controllers;

class SectionsController extends \yii\web\Controller {

    public function actionIndex($event)
    {
        return $this->render('index', ['event' => $event]);
    }
}