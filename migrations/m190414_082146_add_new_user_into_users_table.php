<?php

use yii\db\Migration;

/**
 * Class m190414_082146_add_new_user_into_users_table
 */
class m190414_082146_add_new_user_into_users_table extends Migration
{

    private $username = 'John';

    private $password = '123456';


    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->insert('users', [
            'username' => $this->username,
            'password' => Yii::$app->security->generatePasswordHash($this->password),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'access_token' =>  Yii::$app->security->generateRandomString()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190414_082146_add_new_user_into_users_table cannot be reverted.\n";

        return false;
    }
    */
}
