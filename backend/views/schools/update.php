<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Schools */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Учебные заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="schools-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
