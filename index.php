<?php

declare(strict_types = 1);

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/Src/Exception/exception.php';

$logger = new \App\Logger\Logger();

$logger->log(\App\Logger\LogLevel::EMERGENCY, 'Fire in the hole', ['exc' => 'exception occurred']);

$logger->info('user created successfully', ['id' => 5]);