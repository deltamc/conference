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
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionIndex($event)
    {
        $eventModel = Events::findOne($event);

        if ($eventModel === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Participant::find()->andWhere(['eventId' => $eventModel->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'eventModel'   => $eventModel,
        ]);
    }



    /**
     * Creates a new Participant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $event
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCreate($event)
    {
        $eventModel = Events::findOne($event);

        if ($eventModel === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = new Participant();
        $model->eventId = $eventModel->id;
        $post = Yii::$app->request->post();

        $schools = ArrayHelper::map(Schools::find()->all(), 'id', 'name');
        $schools[0] = 'Другое';

        if ($model->load($post) && $model->save()) {

            $names = [];
            if (isset($post['Participant']['names']['name'])) {
                $names = $post['Participant']['names']['name'];
            }

            $teachers = [];
            if (isset($post['Participant']['teachers']['name'])) {
                $teachers = $post['Participant']['teachers']['name'];
            }

            $model->saveNames($names);
            $model->saveTeachers($teachers);

            return $this->redirect(['index', 'event' => $eventModel->id]);
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

        if ($eventModel === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $model = $this->findModel($id);
        $model->eventId = $eventModel->id;
        $post = Yii::$app->request->post();

        $schools = ArrayHelper::map(Schools::find()->all(), 'id', 'name');

        $schools[0] = 'Другое';

        if ($model->load($post) && $model->save()) {

            $names = [];
            if (isset($post['Participant']['names']['name'])) {
                $names = $post['Participant']['names']['name'];
            }

            $teachers = [];
            if (isset($post['Participant']['teachers']['name'])) {
                $teachers = $post['Participant']['teachers']['name'];
            }
            $model->saveNames($names);
            $model->saveTeachers($teachers);

            return $this->redirect(['index', 'event' => $eventModel->id]);
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

        return $this->redirect(['index', 'event' => (int) $event]);
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
