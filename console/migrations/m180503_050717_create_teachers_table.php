<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teachers`.
 */
class m180503_050717_create_teachers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teachers}}', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string()->notNull(),
            'participantId' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-post-participantId',
            '{{%teachers}}',
            'participantId',
            '{{%participants}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-post-participantId',
            '{{%teachers}}'
        );
        $this->dropTable('teachers');
    }
}
