<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Events */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="events-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dataStartReg')->widget(DateTimePicker::class, [
        'name' => 'dataStartReg',
        //'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'php:d.m.Y h:i:s',
            'startDate' => date('d.m.Y h:i:s'),
            'todayHighlight' => true
    ]]); ?>


    <?= $form->field($model, 'dataEndReg')->widget(DateTimePicker::class, [
        'name' => 'dataEndReg',
        //'options' => ['placeholder' => 'Select operating time ...'],
        'convertFormat' => true,
        'pluginOptions' => [
            'format' => 'php:d.m.Y h:i:s',
            'startDate' => date('d.m.Y h:i:s'),
            'todayHighlight' => true
        ]]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
