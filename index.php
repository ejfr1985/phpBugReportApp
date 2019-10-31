<?php

declare(strict_types = 1);

require_once __DIR__.'/vendor/autoload.php';

$application = new \App\Helpers\App();

echo $application->getServerTime()->format('Y-m-d H:i:s') . PHP_EOL;
echo $application->getLogPath() . PHP_EOL;
echo $application->isRunningFromConsole() . PHP_EOL;
