<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%teachers}}".
 *
 * @property int $id
 * @property string $name
 * @property int $participantId
 *
 * @property Participants $participant
 */
class Teacher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%teachers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'participantId'], 'required'],
            [['participantId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['participantId'], 'exist', 'skipOnError' => true, 'targetClass' => Participant::className(), 'targetAttribute' => ['participantId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'participantId' => 'Participant ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParticipant()
    {
        return $this->hasOne(Participant::className(), ['id' => 'participantId']);
    }

    /**
     * {@inheritdoc}
     * @return TeachersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TeachersQuery(get_called_class());
    }
}
