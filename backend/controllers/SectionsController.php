<?php
namespace backend\controllers;

use backend\models\Events;
use yii\web\NotFoundHttpException;

class SectionsController extends \yii\web\Controller {

    public function actionIndex($event)
    {
        $eventModel = Events::findOne($event);
        if ($eventModel === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('index', ['event' => $eventModel]);
    }
}