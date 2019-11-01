<?php

declare(strict_types = 1);

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/Src/Exception/exception.php';

$db =  new mysqli("asdads", 'root', '', 'bug');

$config = \App\Helpers\Config::getFileContent("rayos");
var_dump($config);
$application = new \App\Helpers\App();

echo $application->getServerTime()->format('Y-m-d H:i:s') . PHP_EOL;
echo $application->getLogPath() . PHP_EOL;
echo $application->isRunningFromConsole() . PHP_EOL;
