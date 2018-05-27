<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use kartik\tree\TreeViewInput;
use  backend\models\Section;
use  kartik\tree\Module;

/* @var $this yii\web\View */
/* @var $model backend\models\Participant */
/* @var $form yii\widgets\ActiveForm */
/* @var $schools array */
/* @var $eventModel backend\models\Events */
?>
<div class="participant-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'sectionId')->widget(
        TreeViewInput::className(),
        [
        'query' => Section::find()->andWhere(['eventId' => $eventModel->id])->addOrderBy('root, lft'),
        'headingOptions' => ['label' => 'Секция'],
        'rootOptions' => ['label'=>'<i class="fa fa-tree text-success"></i>'],
        'fontAwesome' => false,
        'asDropdown' => true,
        'multiple' => false,
        'options' => ['disabled' => false]
    ]) ?>


    <?= $form->field($model, 'names')->widget(MultipleInput::className(), [
        'max'               => 6,
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        //'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'columns' => [
            [
                'title' => 'Имя',
                'name' => 'name',
                'type' => 'textInput',
                'options' => [
                    'required' => 'true'
                ]
            ],
        ],
        'addButtonOptions' => ['label' => 'Добавить соавтора']
    ])
        ->label(false);

    ?>

    <?= $form->field($model, 'schoolId')->dropDownList($schools,['prompt' => ''])?>

    <?= $form->field($model, 'schoolName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'additionalSchool')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'theme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teachers')->widget(MultipleInput::className(), [
        'max'               => 6,
        'allowEmptyList'    => false,
        'enableGuessTitle'  => true,
        //'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
        'columns' => [
            [
                'title' => 'Имя',
                'name' => 'name',
                'type' => 'textInput',
                'options' => [
                    'required' => 'true'
                ]
            ],
        ],
        'addButtonOptions' => ['label' => 'Добавить соавтора']
    ])
        ->label(false);

    ?>

    <?= $form->field($model, 'contacts')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
