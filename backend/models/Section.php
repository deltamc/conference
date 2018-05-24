<?php

namespace backend\models;

use Yii;


class Section extends \kartik\tree\models\Tree
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sections}}';
    }

    public static function getTypes()
    {
        return [
            'section'    => 'Секция',
            'subsection' => 'Подсекция',
            'age_group'  => 'Возрастная группа'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = ['type', 'string'];
        $rules[] = ['eventId', 'integer'];
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $attributes = parent::attributeLabels();
        $attributes['type'] = 'Тип';
        return $attributes;
    }

}