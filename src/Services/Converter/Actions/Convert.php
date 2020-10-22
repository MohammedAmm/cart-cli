<?php

/**
 * This simple action to convert usd to any currency
 */

namespace Services\Converter\Actions;

use Services\Converter\Currency;

class Convert
{
    /**
     * Currency details for current session
     *
     * @var [Array]
     */
    private $currencyArray;
    public function __construct(string $currencyName) {
        $action = new GetConvertDetails();
        $this->currencyArray = $action->excute($currencyName);
    }
    public function excute(float $number) :float
    {
        return $number*$this->currencyArray["rate_to_dollar"];
    }
}