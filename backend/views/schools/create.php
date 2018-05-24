<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Schools */

$this->title = 'Добавление учебного заведения';
$this->params['breadcrumbs'][] = ['label' => 'Учебные заведения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>