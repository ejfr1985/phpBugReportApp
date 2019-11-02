<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 11/2/2019
 * Time: 8:34 AM
 */

namespace App\Contracts;


interface LoggerInterface
{

    public function emergency(string $message, array $context = []);

    public function alert(string $message, array $context = []);

    public function critical(string $message, array $context = []);

    public function error(string $message, array $context = []);

    public function warning(string $message, array $context = []);

    public function notice(string $message, array $context = []);

    public function info(string $message, array $context = []);

    public function debug(string $message, array $context = []);

    public function log(string $level, string $message, array $context = []);

}