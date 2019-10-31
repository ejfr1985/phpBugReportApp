<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 10/31/2019
 * Time: 5:55 PM
 */

declare(strict_types = 1);

namespace App\Helpers;


class Config
{
    public static function get(string $filename, string $key = null)
    {
        $fileContent = self::getFileContent($filename);

        if ($key == null) {
            return $fileContent;
        }

        return isset($fileContent[$key]) ? $fileContent[$key] : [];

    }

    public static function getFileContent(string $filename): array
    {

        $fileContent = [];

        try {

            $path = realpath(sprintf(__DIR__ . '/../Configs/%s.php', $filename));

            if (file_exists($path)) {

                $fileContent = require $path;

            }


        } catch (\Throwable $exception) {

            throw new \RuntimeException(
                sprintf('The file: %s is not found', $filename)
            );

        }

        return $fileContent;

    }

}