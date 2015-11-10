<?php
/**
 * Created by JetBrains PhpStorm.
 * User: amd1648
 * Date: 12.06.13
 * Time: 17:33
 * To change this template use File | Settings | File Templates.
 */

return array(
    PhpAuthManager::ROLE_GUEST => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    PhpAuthManager::ROLE_USER => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'User',
        'bizRule' => null,
        'data' => null
    ),
    PhpAuthManager::ROLE_MANAGER => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Manager',
        'children' => array(
            '0',
        ),
        'bizRule' => null,
        'data' => null
    ),
    PhpAuthManager::ROLE_ADMIN => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            '1',
        ),
        'bizRule' => null,
        'data' => null
    ),
);