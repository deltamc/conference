<?php
/**
 * @var $event backend\models\Section
 */
use kartik\tree\TreeView;
use  backend\models\Section;
use  kartik\tree\Module;
use yii\helpers\Url;

$this->title = 'Секции';
$this->params['breadcrumbs'][] = $event->name;
$this->params['breadcrumbs'][] = $this->title;

echo TreeView::widget([
    'query' => Section::find()->andWhere(['eventId' => $event->id])->addOrderBy('root, lft'),
    'rootOptions' => ['label'=>'<span class="text-primary">Секции</span>'],
    'headingOptions' => ['label' => 'Секции'],
    'topRootAsHeading' => true,
    'fontAwesome' => false,
    'isAdmin' => false,
    'displayValue' => 1,
    'softDelete' => true,
    'cacheSettings' => [
        'enableCache' => false
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