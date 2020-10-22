<?php 
namespace Actions\Bill;

use Models\Cart;

class CalculateTotalTaxes
{
    public function execute(float $subTotal)
    {
        //For simplicity: Tax hard coded within cart as constant we can init it in config or env or init in another json file.
        //Return with total taxes.
        return $subTotal*Cart::TAX_PERCENT;
    }
}