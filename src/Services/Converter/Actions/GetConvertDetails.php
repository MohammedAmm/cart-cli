<?php

/**
 * This simple action to convert usd to any currency
 */

namespace Services\Converter\Actions;

use Services\Converter\Currency;

class GetConvertDetails
{
    public function excute(string $currencyName)
    {
        return $this->getValideCurrency($currencyName);
    }

    private function getValideCurrency(string $name):array
    {
        //Hult if currency not exists
        if (empty($currencyArray=Currency::searchStockForKey($name))) {
            die("Not valide currency");
        }
        //Return with currency details
        return $currencyArray;
    }
}