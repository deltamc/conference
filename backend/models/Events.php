<?php

namespace backend\models;
use  \yii\behaviors\TimeStampBehavior;
use \yii\db\ActiveRecord;
use Yii;
use yii\behaviors\AttributeBehavior;
/**
 * This is the model class for table "{{%events}}".
 *
 * @property int $id
 * @property string $name
 * @property int $dataStartReg
 * @property int $dataEndReg
 */
class Events extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%events}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'dataStartReg', 'dataEndReg'], 'required'],
            [
                ['dataStartReg'],
                'datetime',
                'format'             => Yii::$app->formatter->datetimeFormat,
                'timestampAttribute' => 'dataStartReg'
            ],
            [
                ['dataEndReg'],
                'datetime',
                'format'             => Yii::$app->formatter->datetimeFormat,
                'timestampAttribute' => 'dataEndReg'
            ],
            [['name'], 'string', 'max' => 255],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'name'         => 'Мероприятия ',
            'dataStartReg' => 'Дата начала регистрации',
            'dataEndReg'   => 'Дата окончания регистрации',
        ];
    }

    public function getDataStartReg()
    {

        if (!empty($this->dataStartReg)) {
            return Yii::$app->formatter->asDatetime($this->dataStartReg, Yii::$app->formatter->datetimeFormat);
        }

        return '';
    }

    public function getDataEndReg()
    {
        if (!empty($this->dataEndReg)) {
            return Yii::$app->formatter->asDatetime($this->dataEndReg, Yii::$app->formatter->datetimeFormat);
        }

        return '';
    }


}
