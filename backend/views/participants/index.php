<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Участники';
$this->params['breadcrumbs'][] = $eventModel->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить участника', ['create', 'event' => $eventModel->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'label' => 'Ф.И.О',
                'content' => function($model) {
                    return $model->getNamesList();
                }
            ],
            'theme',
            [
                'label' => 'Учебное заведение',
                'content' => function($model) {
                    return $model->getSchoolName();
                }
            ],
            [
                'label' => 'Секция',
                'content' => function($model) {
                    return $model->getSection();
                }
            ],
            [
                'attribute' => 'additionalSchool',
                'label'     => 'Учереждение ДО'
            ],
            'class',
            //'theme',
            //'contacts',
            [
                'label' => 'Ф.И.О Педагогов',
                'content' => function($model) {
                    return $model->getTeachersList();
                }
            ],
            [
                'attribute' => 'contacts',
                'label'     => 'Телефон, эл. почта'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function($url, $model, $key)  use ($eventModel) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            Url::to(['delete', 'id' => $model->id, 'event' => $eventModel->id]),
                            [
                                'data-confirm' => 'Удалить?',
                            ]
                        );
                    },
                    'update' => function($url, $model, $key) use ($eventModel) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            Url::to(['update', 'id' => $model->id, 'event' => $eventModel->id])
                        );
                    }
                ],
            ],
        ],
    ]); ?>
</div>
