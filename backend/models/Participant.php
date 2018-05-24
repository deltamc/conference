<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%participants}}".
 *
 * @property int $id
 * @property int $schoolId
 * @property string $schoolName
 * @property string $additionalSchool
 * @property string $class
 * @property string $theme
 * @property string $contacts
 *
 * @property Name[] $names
 * @property Schools $school
 * @property Teacher[] $teachers
 */
class Participant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%participants}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['schoolId', 'class', 'theme'], 'required'],
            [['schoolId'], 'integer'],
            [['schoolName', 'additionalSchool', 'class', 'theme', 'contacts'], 'string', 'max' => 255],
            [['schoolId'], 'exist', 'skipOnError' => true, 'targetClass' => Schools::className(), 'targetAttribute' => ['schoolId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schoolId' => 'School ID',
            'schoolName' => 'School Name',
            'additionalSchool' => 'Additional School',
            'class' => 'Class',
            'theme' => 'Theme',
            'contacts' => 'Contacts',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNames()
    {
        return $this->hasMany(Name::className(), ['participantId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(Schools::className(), ['id' => 'schoolId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['participantId' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ParticipantsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParticipantsQuery(get_called_class());
    }
}
