<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 10/31/2019
 * Time: 5:58 PM
 */

return [
    'pdo' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'db_name' => 'general',
        'db_username' => 'homestead',
        'db_user_password' =>'secret',
        'default_fetch' => PDO::FETCH_OBJ,
    ],

    'mysqli' => [
        'host' => 'localhost',
        'db_name' => 'general',
        'db_username' => 'homestead',
        'db_user_password' =>'secret',
        'default_fetch' => MYSQLI_ASSOC,
    ],


];