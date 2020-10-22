<?php

/**
 * 
 */

namespace Services\Converter;

class Currency
{

    public static function readJson($fileName)
    {      
        // get the contents of the JSON file 
        return file_get_contents(__DIR__."/".$fileName);
    }
    public static function jsonToArray($jsonData, $key)
    {      
        //decode JSON data to PHP array
        return json_decode($jsonData, true)[$key];
    }

    public static function getStock()
    {
        $jsonData = self::readJson("currencies.json");
        return self::jsonToArray($jsonData, "currencies");
    }

    public static function searchStockForKey($key): array
    {
        //Array for stock info.
        $result=[];
        foreach (self::getStock() as $stock) {
            if ($stock["name"]==$key) {
                $result = $stock;
                break;
            }
        }
        return $result;
    }
}