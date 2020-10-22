<?php

/**
 * 
 */

namespace Models;

class Offer extends BaseModel
{
    public static function getStock()
    {
        $jsonData = self::readJson("offers.json");
        return self::jsonToArray($jsonData, "offers");
    }
}