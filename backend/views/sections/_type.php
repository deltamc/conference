<?php
use backend\models\Section;
echo $form->field($node, 'type')->dropDownList(Section::getTypes());