<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\tree\TreeViewInput;
use  backend\models\Section;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Участники';
$this->params['breadcrumbs'][] = $eventModel->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<form>
    <div class="row">
        <div class="col-md-1 text-right" style="line-height: 30px;">
            Секция:
        </div>
        <div class="col-md-5">
        <?php

        ?>

        <?= TreeViewInput::widget(
        [
            'name' => 'section',
            'query' => Section::find()->andWhere(['eventId' => $eventModel->id])->addOrderBy('root, lft'),
            'headingOptions' => ['label' => 'Секция'],
            'rootOptions' => ['label'=>'<i class="fa fa-tree text-success"></i>'],
            'fontAwesome' => false,
            'asDropdown' => true,
            'multiple' => false,
            'options' => ['disabled' => false],
            'value' => yii::$app->request->get('section', null)
        ]) ?>
        </div>
        <div class="col-md-6" style="line-height: 30px;">
            <input type="hidden" value="<?= $eventModel->id?>" name="event">
            <input type="submit" value="Показать" class="btn btn-success">
        </div>
    </div>
</form>


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
