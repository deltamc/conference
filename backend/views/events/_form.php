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
        'name'    => 'dataStartReg',
        'options' => [
            'value' => $model->getDataStartReg(),
        ],
        'convertFormat' => true,
        'pluginOptions' => [
            'format'         => Yii::$app->formatter->datetimeFormat,
            'todayHighlight' => true,
            'autoclose' => true,
    ]]); ?>


    <?= $form->field($model, 'dataEndReg')->widget(DateTimePicker::class, [
        'name' => 'dataEndReg',
        'convertFormat' => true,
        'options' => [
            'value' => $model->getDataEndReg(),
        ],
        'pluginOptions' => [
            'format'         => Yii::$app->formatter->datetimeFormat,
            'todayHighlight' => true,
            'autoclose' => true,
        ]]); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
