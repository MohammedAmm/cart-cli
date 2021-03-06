<?php
namespace Commands;

use Models\Cart;
use Controllers\BillController;
use Actions\Cart\AddProductToCart;
use Actions\Cart\SetCurrentCurrency;

class CreateCart implements CommandInterface
{
    /**
     * @var [Controller]
     */
    private $controller;
    /**
     * @var [Model]
     */
    private $cart;
    /**
     * @var [Action]
     */
    private $action;

    /**
     * @var [Action]
     */
    private $setCurrencyAction;

    public function __construct()
    {
        $this->controller = new BillController();
        $this->cart = new Cart();
        $this->action = new AddProductToCart();
        $this->setCurrencyAction= new SetCurrentCurrency();
    }

    public function handle($argv)
    {
        //Get items start index in command line
        $itemIndex = $this->getItemStartIndex($argv[2]);

        //Set currency only if option passed.
        if ($itemIndex == 3) {
            $currencyName = $this->getCurrency($argv[2]);
            $this->setCurrencyAction->execute($currencyName,$this->cart);
        }


        //Get request from command and handle to controller
        for ($i = $itemIndex; $i < sizeof($argv); $i++) {
            $this->addProdcutToCart($argv[$i]);
        }
        //Init cart with productis
        $this->controller->create($this->cart);

    }

    private function addProdcutToCart(string $productName)
    {
        $this->action->execute($this->ignoreSentivity($productName), $this->cart);
    }

    private function ignoreSentivity(string $productName): string
    {
        //Ignore case senstivity
        return ucfirst(strtolower($productName));
    }

    private function getCurrency(string $text): string
    {
        $array=explode("=", $text);
        //Array[1] should have the currency
        //Ignore case senstivity
        return strtoupper($array[1]);
    }
    private function getItemStartIndex(string $argumentText):int
    {    
        if (strpos($argumentText, '--') !== false) {
            return 3;
        }
        return 2;
    }
}
