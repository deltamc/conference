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


    /**
     *
     * @param string $separator
     * @return string
     */
    public function breadcrumbs($separator = ' / ')
    {
        $sections = Section::find()
            ->andWhere(['eventId' => $this->eventId])
            ->andWhere(['<', 'lft', $this->lft ])
            ->andWhere(['>', 'rgt', $this->rgt ])
            ->addOrderBy('lft')->all();
        $out = '';
        foreach ($sections as $item) {
            $out .= $item->name . $separator;
        }
        $out .= $this->name;
        $out = trim($out, $separator);

        return $out;
    }

}