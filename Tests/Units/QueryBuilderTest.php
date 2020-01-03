<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 11/17/2019
 * Time: 6:27 AM
 */

namespace Tests\Units;


use App\Database\PDOConnection;
use App\Database\PDOQueryBuilder;
use App\Database\QueryBuilder;
use App\Helpers\Config;
use PHPUnit\Framework\TestCase;

class QueryBuilderTest extends TestCase
{

    /** @var  QueryBuilder $queryBuilder */
    private $queryBuilder;


    public function setUp()
    {
        $credentials = array_merge(
            Config::get('database', 'pdo'),
            ['db_name' => 'general_testing']
        );

        $pdo = new PDOConnection(
            $credentials
        );

        $this->queryBuilder = new PDOQueryBuilder(
            $pdo->connect()
        );
        parent::setUp();
    }


    public function testItCanCreateRecords()
    {

        $data = [
            'report_type' => 'Report Type 1',
            'message' => 'This is a Test Message',
            'email' => 'loco@email.com',
            'link' => 'www.link.com',
            'created_at' => date('Y-m-d H:i:s'),

        ];
        $id = $this->queryBuilder->table('reports')->create($data);
        self::assertNotNull($id);
    }


    public function testItCanPerformRawQuery()
    {


        $result = $this->queryBuilder->raw("SELECT * FROM reports;")->get();
        self::assertNotNull($result);


    }

    public function testItCanPerformSelectQuery()
    {
        $results = $this->queryBuilder
            ->table('reports')
            ->select('*')
            ->where('id', 1)->first();

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
        self::assertSame(1, (int)$results->id);
        self::assertSame('Report Type 1', $results->report_type);
    }
}