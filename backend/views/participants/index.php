<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Participant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'schoolId',
            'schoolName',
            'additionalSchool',
            'class',
            //'theme',
            //'contacts',

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
