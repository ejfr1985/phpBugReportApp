<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 10/31/2019
 * Time: 6:49 PM
 */
declare(strict_types = 1);

namespace App\Exception;


use App\Helpers\App;
use Throwable;

class ExceptionHandler
{
    public function handle(Throwable $exception): void
    {
       $application = new App;

        if($application->isDebugMode()){
            var_dump($exception);
        }else{

            echo "An error occurred";

        }
        exit;
    }

    public function convertWarningsAndNoticesToException($severity, $message, $file, $line)
    {
        throw new \ErrorException($message, $severity, $severity, $file, $line);
    }
}