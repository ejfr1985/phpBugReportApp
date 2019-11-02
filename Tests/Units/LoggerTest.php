<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 11/2/2019
 * Time: 9:39 AM
 */

namespace Tests\Units;


use App\Contracts\LoggerInterface;
use App\Exception\InvalidLogLevelArgument;
use App\Helpers\App;
use App\Logger\Logger;
use App\Logger\LogLevel;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @var Logger $logger
     */
    private $logger;

    public function setUp()
    {
        $this->logger = new Logger;
        parent::setUp();
    }


    public function testItImplementsLoggerInterface()
    {
        self::assertInstanceOf(LoggerInterface::class, $this->logger);
    }

    public function testItCanCreateDifferentTypesOfLogLevel()
    {
        $this->logger->info("Testing info Log");
        $this->logger->error("Testing error Log");
        $this->logger->log(LogLevel::ALERT, "Testing alert Log");

        $app = new App;

        $fileName = sprintf("%s/%s-%s.log", $app->getLogPath(), 'test', date("j.n.Y"));

        self::assertFileExists($fileName);

        $contentOfLogFile = file_get_contents($fileName);

        self::assertStringContainsString("Testing info Log", $contentOfLogFile);
        self::assertStringContainsString("Testing error Log", $contentOfLogFile);
        self::assertStringContainsString(LogLevel::ALERT, $contentOfLogFile);

        unlink($fileName);

        self::assertFileNotExists($fileName);

    }

    public function testItThrowsInvalidLogLevelArgumentExceptionWhenGivenAWrongLogLevel()
    {
        self::expectException(InvalidLogLevelArgument::class);

        $this->logger->log('invalid', 'testing invalid log level');

    }

}