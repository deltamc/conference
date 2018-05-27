<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Participant */

$this->title = 'Добавление участника ';
$this->params['breadcrumbs'][] = $eventModel->name;
$this->params['breadcrumbs'][] = ['label' => 'Участники', 'url' => ['/participants', 'event'=> $eventModel->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'   => $model,
        'schools' => $schools,
        'eventModel' => $eventModel,
    ]) ?>

</div>
