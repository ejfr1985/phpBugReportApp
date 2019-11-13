<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 11/7/2019
 * Time: 2:37 PM
 */

namespace Tests\Units;


use App\Contracts\DatabaseConnectionInterface;
use App\Database\MySQLiConnection;
use App\Database\PDOConnection;
use App\Exception\MissingArgumentException;
use App\Helpers\App;
use App\Helpers\Config;
use mysqli;
use PDO;
use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    public function testItThrowsMissingArgumentExceptionWithWrongCredentialsKeys()
    {
        self::expectException(MissingArgumentException::class);
        $credentials = [];
        $pdoHandler = (new PDOConnection($credentials))->connect();
    }

    public function testItCanConnectWithPdoApi()
    {

        $credentials = $this->getCredentials('pdo');
        $pdoHandler = (new PDOConnection($credentials))->connect();
        self::assertInstanceOf(DatabaseConnectionInterface::class, $pdoHandler);

        return $pdoHandler;

    }

    /** @depends testItCanConnectWithPdoApi */
    public function testItIsValidPdoConnection(DatabaseConnectionInterface $handler)
    {
        self::assertInstanceOf(PDO::class, $handler->getConnection());
    }


    public function testItCanConnectWithMysqliApi()
    {

        $credentials = $this->getCredentials('mysqli');
        $mysqliHandler = (new MySQLiConnection($credentials))->connect();
        self::assertInstanceOf(DatabaseConnectionInterface::class, $mysqliHandler);

        return $mysqliHandler;

    }

    /** @depends testItCanConnectWithMysqliApi */
    public function testItIsValidMysqliConnection(DatabaseConnectionInterface $handler)
    {
        self::assertInstanceOf(mysqli::class, $handler->getConnection());
    }



    private function getCredentials(string $type)
    {

        return array_merge(

            Config::get('database', $type),
            ['db_name' => 'general_testing']
        );

    }
}