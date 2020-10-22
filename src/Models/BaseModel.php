<?php

/**
 * 
 */

namespace Models;

class BaseModel
{
    public static function readJson($fileName)
    {      
        // get the contents of the JSON file 
        return file_get_contents(__DIR__."/../Store/".$fileName);
    }
    public static function jsonToArray($jsonData, $key)
    {      
        //decode JSON data to PHP array
        return json_decode($jsonData, true)[$key];
    }

}