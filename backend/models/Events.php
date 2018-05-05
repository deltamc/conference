<?php

namespace backend\models;
use  \yii\behaviors\TimeStampBehavior;
use \yii\db\ActiveRecord;
use Yii;

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
            [['dataStartReg', 'dataEndReg'], 'date', 'format'=>'php:d.m.Y H:i:s'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'dataStartReg',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'dataEndReg',
                ],
                'value' => function() { return date('U'); },
            ],
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
}
