<?php
namespace Actions\Cart;

use Models\Cart;
use Models\Product;

class AddProductToCart
{
    public function execute(string $productName, Cart $cart)
    {
        //Get product array info if valid or hult the program and raise error.
        $productArray=$this->getProductIfExists($productName);

        // object exists in array; don't add a new one just increase count and quit.
        if (isset($cart->get()[$productName])) {
            //Get product
            $product = $cart->get()[$productName];
            $product->increaseCount();
            return;
        } 
        //Create new product object
        $cart->add(Product::create($productArray));
    }

    private function getProductIfExists($productName):array
    {
        if (empty($productArray = Product::searchStockForKey($productName))) {
            die("Product not found.\n");
        }     
        return $productArray;
    }
}
