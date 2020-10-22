<?php 
namespace Actions\Bill;

use Models\Product;

class GetSubTotal
{
    /* @float totalCost*/
    private $totalCost;

    /* @float Actions\Bill\CalculateItemCost*/
    private $calculateItemCost;

    public function __construct() {
        $this->totalCost=0;
        $this->calculateItemCost = new CalculateItemCost();
    }
    public function execute(array $products)
    {
        foreach ($products as $product) {
            //sum all costs of products with cart without taxes and discounts
            $this->totalCost += $this->calculateItemCost->execute($product);
        }

        return $this->totalCost;
    }
}