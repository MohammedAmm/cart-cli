<?php

namespace Tests\Unit\Models;

use Models\Product;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /** @test */
    function can_get_all_products_from_store()
    {
        $products = Product::getStockProducts();
        $this->assertNotEmpty($products);
    }

    /** @test */
    function can_search_stock_products_for_key()
    {
        $searchKey="T-shirt";
        $productInfo = Product::searchStockForKey($searchKey);
        $this->assertEquals($productInfo["name"],$searchKey);
    }
    /** @test */
    function return_null_when_product_not_found()
    {
        $searchKey="Test";
        $productInfo = Product::searchStockForKey($searchKey);
        $this->assertEmpty($productInfo);
    }

    /** @test */
    function can_create_product_object_from_array()
    {
        $productArray=["name"=>"new", "price"=>100, "discount"=>10];
        $productObject = Product::create($productArray);
        $this->assertEquals($productArray["name"],$productObject->getName());
    }
    
    /** @test */
    function can_get_product_object_name()
    {
        $productArray=["name"=>"new", "price"=>100, "discount"=>10];
        $productObject = Product::create($productArray);
        $this->assertEquals($productArray["name"],$productObject->getName());
    }

    /** @test */
    function can_get_product_object_price()
    {
        $productArray=["name"=>"new", "price"=>100, "discount"=>10];
        $productObject = Product::create($productArray);
        $this->assertEquals($productArray["price"],$productObject->getPrice());
    }


    /** @test */
    function can_get_product_object_discount()
    {
        $productArray=["name"=>"new", "price"=>100, "discount"=>10];
        $productObject = Product::create($productArray);
        $this->assertEquals($productArray["discount"],$productObject->getDiscount());
    }
}