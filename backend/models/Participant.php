<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

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
            [['schoolId', 'class', 'theme', 'sectionId'], 'required'],
            [['schoolId', 'sectionId'], 'integer'],
            [['schoolName', 'additionalSchool', 'class', 'theme', 'contacts'], 'string', 'max' => 255],
            //[['schoolId'], 'exist', 'skipOnError' => true, 'targetClass' => Schools::className(), 'targetAttribute' => ['schoolId' => 'id']],



        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schoolId' => 'Наименование учебного заведения:',
            'schoolName' => 'Наименование учебного заведения:',
            'additionalSchool' => 'Учреждение дополнительного образования',
            'class' => 'Класс (курс)',
            'theme' => 'Тема работы',
            'sectionId' => 'Секция',
            'contacts' => 'Телефон и (или) адрес электронной почты',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNames()
    {
        return $this->hasMany(Name::className(), ['participantId' => 'id']);
    }

    public function getNamesList()
    {
        $out = '';
        foreach ($this->names as $item) {
            $out .= $item->name . '<br />';
        }

        return $out;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchool()
    {
        return $this->hasOne(Schools::className(), ['id' => 'schoolId']);
    }

    public function getSchoolName()
    {
        if ($this->schoolId === null) {
            return $this->schoolName;
        }

        $school = $this->school;
        return $school ? $school->name : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeachers()
    {
        return $this->hasMany(Teacher::className(), ['participantId' => 'id']);
    }

    public function getTeachersList()
    {
        $out = '';
        foreach ($this->teachers as $item) {
            $out .= $item->name . '<br />';
        }

        return $out;
    }

    /**
     * {@inheritdoc}
     * @return ParticipantsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ParticipantsQuery(get_called_class());
    }

    public function saveNames(array $names)
    {
        Name::deleteAll(['participantId' => $this->id]);

        foreach ($names as $name)
        {
            $model = new Name();
            $model->name = $name;
            $model->participantId = $this->id;
            $model->save();
        }

        return true;
    }

    public function saveTeachers(array $names)
    {
        Teacher::deleteAll(['participantId' => $this->id]);

        foreach ($names as $name)
        {
            $model = new Teacher();
            $model->name = $name;
            $model->participantId = $this->id;
            $model->save();
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        $result = parent::beforeSave($insert);

        if ((int) $this->schoolId === 0) {
            $this->schoolId = null;
        }

        return $result;
    }
    /**
     * {@inheritdoc}
     */
    public function delete()
    {
        Name::deleteAll(['participantId' => $this->id]);
        Teacher::deleteAll(['participantId' => $this->id]);
        parent::delete();
    }
}
