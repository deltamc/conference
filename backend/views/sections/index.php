<?php
/**
 * @var $event backend\models\Section
 */
use kartik\tree\TreeView;
use  backend\models\Section;
use  kartik\tree\Module;
use yii\helpers\Url;

$this->title = 'Секции';
$this->params['breadcrumbs'][] = ['label'=>'Мероприятия', 'url'=>['/events']];
$this->params['breadcrumbs'][] = $event->name;
$this->params['breadcrumbs'][] = $this->title;

echo TreeView::widget([
    // single query fetch to render the tree
    // use the Product model you have in the previous step
    'query' => Section::find()->andWhere(['eventId' => $event->id])->addOrderBy('root, lft'),
    'rootOptions' => ['label'=>'<span class="text-primary">Секции</span>'],
    'headingOptions' => ['label' => 'Секции'],
    'topRootAsHeading' => true, // this will override the headingOptions
    'fontAwesome' => false,     // optional
    'isAdmin' => false,         // optional (toggle to enable admin mode)
    'displayValue' => 1,        // initial display value
    'softDelete' => true,       // defaults to true
    'cacheSettings' => [
        'enableCache' => false   // defaults to true
    ],
    'nodeAddlViews' => [
        Module::VIEW_PART_2 => '@backend/views/sections/_type'
    ],
    'iconEditSettings' => [
        'show' => 'none'
    ],
    'showIDAttribute' => false,
    'nodeActions' => [
        Module::NODE_MANAGE => Url::to(['/treemanager/node/manage', 'event' => $event->id]),
    ]

]);