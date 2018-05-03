<?php

use yii\db\Migration;

/**
 * Handles the creation of table `names`.
 */
class m180503_045858_create_names_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%names}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'participantId' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-post-participantId',
            '{{%names}}',
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
            '{{%names}}'
        );
        $this->dropTable('{{%names}}');
    }
}
