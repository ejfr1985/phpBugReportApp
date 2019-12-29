<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 11/17/2019
 * Time: 6:27 AM
 */

namespace Tests\Units;


use App\Database\PDOConnection;
use App\Database\QueryBuilder;
use App\Helpers\Config;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{

    /** @var  QueryBuilder $queryBuilder */
    private $queryBuilder;


    public function setUp()
    {

        $pdo =  new PDOConnection(
            Config::get('database', 'pdo'),
            ['db_name' => 'general_testing']);

        $this->queryBuilder = new QueryBuilder(
           $pdo->connect()
        );
        parent::setUp();
    }


    public function testItCanCreateRecords()
    {
        $id = $this->queryBuilder->table('reports')->create($data);
        self::assertNotNull($id);
    }


    public function testItCanPerformRawQuery()
    {


        $result = $this->queryBuilder->raw("SELECT * FROM reports;");
        self::assertNotNull($result);


    }

    public function testItCanPerformSelectQuery()
    {
        $results = $this->queryBuilder
            ->table('reports')
            ->select('*')
            ->where('id', 1);
        var_dump($results->query);
        exit;
            //->first();
        self::assertNotNull($results);
        self::assertSame(1, (int)$results->id);
    }

    public function testItCanPerformSelectQueryWithMultipleClause()
    {
        $results = $this->queryBuilder
            ->table('reports')
            ->select('*')
            ->where('id', 1)
            ->where('report_type', '=', 'Report Type 1')
            ->first();

        self::assertNotNull($results);
        self::assertSame('Report Type 1', $results->id);
    }
}