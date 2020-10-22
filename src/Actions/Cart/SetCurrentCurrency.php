<?php
namespace Actions\Cart;

use Models\Cart;
use Services\Converter\Actions\GetConvertDetails;

class SetCurrentCurrency
{   
    private $action;

    public function __construct() {
        $this->action=new GetConvertDetails();
    }

    public function execute(string $currencyName, Cart $cart)
    {
        //If the currency not valid will hult the program no need to check after.
        $this->action->excute($currencyName);
        $cart->setCurrency($currencyName);

    }

}
