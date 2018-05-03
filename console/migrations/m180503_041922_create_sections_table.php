<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sections`.
 */
class m180503_041922_create_sections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sections}}', [
            'id'       => $this->primaryKey(),
            'name'     => $this->string()->notNull(),
            'type'     => "ENUM('section', 'subsection', 'age_group')",
            'parentId' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-sections-parentId',
            '{{%sections}}',
            'parentId'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sections}}');
    }
}
