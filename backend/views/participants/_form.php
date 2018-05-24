<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Participant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="participant-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'names')->widget(MultipleInput::className(), [
        'max'               => 6,
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        //'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'columns' => [
            [
                'title' => 'Имя',
                'name' => 'name',
                'type' => 'textInput'
            ],
        ],
        'addButtonOptions' => ['label' => 'Добавить соавтора']
    ])
        ->label(false);

    ?>

    <?= $form->field($model, 'schoolId')->textInput() ?>

    <?= $form->field($model, 'schoolName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'additionalSchool')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'theme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacts')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
