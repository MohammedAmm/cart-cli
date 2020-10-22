<?php
namespace Models;

class Cart
{
    /**
     * Tax Percent.
     */
    const TAX_PERCENT = 0.14;

    /**
     * Cart array to store list of products.
     */
    private $shoppingCart;

   /**
     * Currency for current cart.
     */
    private $currency;

    public function __construct()
    {
        $this->shoppingCart = [];
        //Set default currency
        $this->currency='USD';
    }

    /**
     * Setters
     */
    public function add(Product $product)
    {
        $this->shoppingCart[$product->getName()] = $product;
    }

    public function setCurrency($currencyName)
    {
        $this->currency=$currencyName;
    }

    /**
     * Getters
     */
    public function get()
    {
        return $this->shoppingCart;
    }
    
    public function getCurrency()
    {
        return $this->currency;
    }
    
}
