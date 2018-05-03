<?php

use yii\db\Migration;

/**
 * Handles the creation of table `participants`.
 */
class m180503_044820_create_participants_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%participants}}', [
            'id'               => $this->primaryKey(),
            'schoolId'         => $this->integer()->notNull(),
            'schoolName'       => $this->string()->null(),
            'additionalSchool' => $this->string()->null(),
            'class'            => $this->string()->notNull(),
            'theme'            => $this->string()->notNull(),
            'contacts'         => $this->string()->null(),
        ]);

        $this->addForeignKey(
            'fk-post-schoolId',
            '{{%participants}}',
            'schoolId',
            '{{%schools}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%participants}}');
    }
}
