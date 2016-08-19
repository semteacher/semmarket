<?php
/**
 * Created by PhpStorm.
 * User: SemenetsA
 * Date: 5.07.2015
 * Time: 16:27
 */
define('DEFAULT_SITE_ROLE', 'guest');

$acl = [
    'admin' => [
        'site' => ['index', 'login', 'logout', 'err403'],
        'albums' => ['share', 'selectcontacts', 'sharereport'],
        'events' => ['share'],
        'contacts' => ['index', 'edit', 'save', 'del', 'select'],
        'users' => ['index', 'edit', 'save', 'del', 'add', 'changepassword'],
        'shoppingcart' => ['index', 'saveorder', 'receipt'],
        'products' => ['index']
    ],
    'user' => [
        'site' => ['index', 'login', 'logout', 'err403'],
        'albums' => ['share'],
        'events' => ['share'],
        'users' => ['index'],
        'shoppingcart' => ['index', 'saveorder', 'receipt'],
        'products' => ['index']
    ],
    'guest' => [
        'site' => ['index', 'login', 'err403'],
        'shoppingcart' => ['index', 'saveorder', 'receipt'],
        'products' => ['index']
    ]
];
