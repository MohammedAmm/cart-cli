<?php

/**
 * 
 */

namespace Controllers;

use Models\Product;

class ShoppingCart
{
    private $products = [];

    public function addProduct(Product $item){
        // object exists in array; don't add a new one just increase count and quit.
        if (isset($this->products[$item->getName()])) {
            $this->products[$item->getName()]->increaseCount();
            return;
        } 
        $this->products[$item->getName()] = $item;
    }

    public function getProducts(){
        return $this->products;
    }

}