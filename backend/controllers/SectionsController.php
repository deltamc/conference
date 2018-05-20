<?php
namespace backend\controllers;

class SectionsController extends \yii\web\Controller {

    public function actionIndex()
    {
        return $this->render('index');
    }
}