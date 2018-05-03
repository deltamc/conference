<?php

use yii\db\Migration;

/**
 * Handles the creation of table `schools`.
 */
class m180503_044448_create_schools_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schools}}', [
            'id'   => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%schools}}');
    }
}
