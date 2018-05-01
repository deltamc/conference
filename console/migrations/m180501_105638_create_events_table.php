<?php

use yii\db\Migration;

/**
 * Handles the creation of table `events`.
 */
class m180501_105638_create_events_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%events}}', [
            'id'           => $this->primaryKey(),
            'name'         => $this->string()->notNull(),
            'dataStartReg' => $this->integer()->notNull(),
            'dataEndReg'   => $this->integer()->notNull(),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%events}}');
    }
}
