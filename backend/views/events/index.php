<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мероприятия';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="events-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить мероприятие', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute'=>'name',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        $data->name,
                        Url::to(['update', 'id' => $data->id])
                    );
                }
            ],
            [
                'label' => '',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        'Секции',
                        Url::to(['sections/', 'event'=>$data->id])
                    );
                }
            ],
            [
                'label' => '',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a(
                        'Участники',
                        Url::to(['participants/', 'event' => $data->id])
                    );
                }
            ],
            'dataStartReg:datetime',
            'dataEndReg:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'buttons' => [
                    'delete' => function($url, $model, $key) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-trash"></span>',
                            Url::to(['delete', 'id' => $model->id]),
                            [
                                'data-confirm' => 'Удалить?',
                            ]
                        );
                    }
                ],
            ],
        ],
    ]); ?>
</div>
