<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%events}}".
 *
 * @property int $id
 * @property string $name
 * @property int $dataStartReg
 * @property int $dataEndReg
 */
class Events extends \yii\db\ActiveRecord
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
            [['dataStartReg', 'dataEndReg'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'dataStartReg' => 'Data Start Reg',
            'dataEndReg' => 'Data End Reg',
        ];
    }
}
