<?php

use yii\db\Migration;

/**
 * Class m190414_084059_add_rbac_roles_and_assignments
 */
class m190414_084059_add_rbac_roles_and_assignments extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $administrator = $auth->createRole('administrator');

        $createPermission = $auth->createPermission('create');
        $createPermission->description = 'user can add array';

        $auth->add($createPermission);
        $auth->add($administrator);

        $auth->addChild($administrator, $createPermission);

        $auth->assign($administrator, 1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190414_084059_add_rbac_roles_and_assignments cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190414_084059_add_rbac_roles_and_assignments cannot be reverted.\n";

        return false;
    }
    */
}
