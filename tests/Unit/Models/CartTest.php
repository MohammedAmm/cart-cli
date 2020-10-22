<?php

namespace Tests\Unit\Models;

use Models\Cart;
use Models\Product;

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    /** @test */
    function can_add_prodcut_to_cart()
    {
        $cart = new Cart();
        $productArray=["name"=>"T-shirt", "price"=>100, "discount"=>10];
        $productObject = Product::create($productArray);
        $cart->add($productObject);
        $products=$cart->get();
        $this->assertNotEmpty($products);
    }
    /** @test */
    function return_with_empty_array_if_no_products_in_cart()
    {
        $cart = new Cart();
        $products=$cart->get();
        $this->assertEmpty($products);
    }
    /** @test */
    function can_get_currency_from_cart()
    {
        $cart = new Cart();
        $currency=$cart->getCurrency();
        $this->assertEquals($currency,"USD");
    }
    /** @test */
    function can_set_currency_to_cart()
    {
        $cart = new Cart();
        $cart->setCurrency("EGP");
        $currency=$cart->getCurrency();
        $this->assertEquals($currency,"EGP");
    }
}