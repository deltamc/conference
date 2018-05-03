<?php

use yii\db\Migration;

/**
 * Handles the creation of table `teachers`.
 */
class m180503_051810_create_teachers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('teachers', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('teachers');
    }
}
