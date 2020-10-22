<?php
namespace Actions\Bill;

use Models\Product;

class CalculateItemCost
{
    public function execute(Product $product)
    {
        return $product->getPrice() * $product->getCount();
    }

}
