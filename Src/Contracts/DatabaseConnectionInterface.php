<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 11/7/2019
 * Time: 2:42 PM
 */

namespace App\Contracts;


interface DatabaseConnectionInterface
{
    public function connect();
    public function getConnection();

}