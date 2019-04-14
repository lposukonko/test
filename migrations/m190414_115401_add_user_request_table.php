<?php

use yii\db\Migration;

/**
 * Class m190414_115401_add_user_request_table
 */
class m190414_115401_add_user_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users_request', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'request' => $this->string(),
            'response' => $this->integer(),
            'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->addForeignKey('users_request__user_id__users__id__fk', 'users_request', 'user_id', 'users', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('users_request__user_id__users__id__fk', 'users_request');
        $this->dropTable('users_request');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190414_115401_add_user_request_table cannot be reverted.\n";

        return false;
    }
    */
}
