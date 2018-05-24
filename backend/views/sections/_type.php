<?php
use backend\models\Section;


$eventId = (int) Yii::$app->request->get('event');
echo $form->field($node, 'type')->dropDownList(Section::getTypes());

echo $form->field($node, 'eventId')->hiddenInput(['value' => $eventId])->label(false, ['style'=>'display:none']);