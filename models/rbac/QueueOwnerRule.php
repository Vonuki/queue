<?php

namespace app\models\rbac;

use yii\rbac\Rule;

/**
 * Проверяем authorID на соответствие с пользователем, переданным через параметры
 */
class QueueOwnerRule extends Rule
{
    public $name = 'isQueueOwner';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated width.
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        $owner_model = Owner::finedByUser($user); //Owner::getUserOwner();
        return isset($params['queue']) ? $params['queue']->idOwner == $owner_model->idOwner : false;
    }
}