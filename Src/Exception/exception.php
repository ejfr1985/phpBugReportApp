<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 10/31/2019
 * Time: 7:05 PM
 */

set_error_handler([new \App\Exception\ExceptionHandler(), 'convertWarningsAndNoticesToException']);
set_exception_handler([new \App\Exception\ExceptionHandler(), 'handle']);