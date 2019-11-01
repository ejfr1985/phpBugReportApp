<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 10/31/2019
 * Time: 6:38 PM
 */

declare(strict_types = 1);

namespace App\Exception;

use Exception;
use Throwable;

abstract class BaseException extends Exception
{

    protected $data = [];

    public function __construct(
        string $message = "",
        array $data = [],
        int $code = 0,
        Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string $key
     *  @param string $value
     */
    public function setData(string $key, string $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * @return array
     */
    public function getExtraData(): array
    {
        if(count($this->data) === 0){
            return $this->data;
        }
        return json_decode(json_encode($this->data), true);
    }

}