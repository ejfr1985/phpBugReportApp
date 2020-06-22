<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 6/22/2020
 * Time: 10:16 AM
 */

namespace App\Helpers;


use App\Database\MySQLiConnection;
use App\Database\MySQLiQueryBuilder;
use App\Database\PDOConnection;
use App\Database\PDOQueryBuilder;
use App\Database\QueryBuilder;
use App\Exception\DataBaseConnectionException;

class DbQueryBuilderFactory
{
    public static function make(
        string $credentialFile = "database",
        string $connectionType = "pdo",
        array $options = []
    ): QueryBuilder {


        $connection = null;

        $credentials = array_merge(Config::get($credentialFile, $connectionType), $options);

        switch ($connectionType) {

            case 'pdo':

                $connection = (new PDOConnection($credentials))->connect();
                return new PDOQueryBuilder($connection);

                break;
            case 'mysqli':

                $connection = (new MySQLiConnection($credentials))->connect();
                return new MySQLiQueryBuilder($connection);

                break;
            default:

                throw new DataBaseConnectionException(
                    "Connection type is not recognized",
                    ["type" => $connectionType]
                );

                break;
        }


    }
}