<?php

namespace backend\controllers;

use Yii;
use backend\models\Participant;
use backend\models\Schools;
use backend\models\Events;
use backend\models\Name;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use yii\base\Model;

/**
 * ParticipantController implements the CRUD actions for Participant model.
 */
class ParticipantsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Participant models.
     * @param integer $event
     * @return mixed
     */
    public function actionIndex($event)
    {
        $eventModel = Events::findOne($event);
        $dataProvider = new ActiveDataProvider([
            'query' => Participant::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'eventModel'   => $eventModel,
        ]);
    }

    /**
     * Displays a single Participant model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Participant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $event
     * @return mixed
     */
    public function actionCreate($event)
    {
        $eventModel = Events::findOne($event);
        $model = new Participant();
        $post = Yii::$app->request->post();

        $schools = ArrayHelper::map(Schools::find()->all(), 'id', 'name');

        if ($model->load($post) && $model->save()) {

            $names = [];
            if (isset($post['Participant']['names']['name'])) {
                $names = $post['Participant']['names']['name'];
            }
            $model->saveNames($names);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'schools' => $schools,
            'eventModel' => $eventModel,
        ]);
    }

    /**
     * Updates an existing Participant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $event
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id, $event)
    {
        $eventModel = Events::findOne($event);
        $model = $this->findModel($id);
        $post = Yii::$app->request->post();

        $schools = ArrayHelper::map(Schools::find()->all(), 'id', 'name');

        $schools[0] = 'Другая';

        if ($model->load($post) && $model->save()) {

            $names = [];
            if (isset($post['Participant']['names']['name'])) {
                $names = $post['Participant']['names']['name'];
            }
            $model->saveNames($names);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model'   => $model,
            'schools' => $schools,
            'eventModel' => $eventModel,

        ]);
    }

    /**
     * Deletes an existing Participant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $event
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $event)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Participant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Participant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
