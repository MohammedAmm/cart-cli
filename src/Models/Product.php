<?php

/**
 *
 */

namespace Models;

class Product extends BaseModel
{
    private $name, $price, $discount, $count = 0;

    /**
     * Getters
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public static function getStockProducts()
    {

        $jsonData = self::readJson("products.json");
        return self::jsonToArray($jsonData, "products");
    }

    public static function searchStockForKey($key): array
    {
        //Array for product info.
        $result = [];
        foreach (self::getStockProducts() as $product) {
            if ($product["name"] == $key) {
                $result = $product;
                break;
            }
        }
        return $result;
    }
    public function increaseCount()
    {
        $this->count++;
    }
    public function getCount(): int
    {
        return $this->count;
    }
    public static function create(array $data): Product
    {
        $product = new self;
        foreach ($data as $key => $value) {
            $product->$key = $value;
        }
        $product->increaseCount();
        return $product;
    }

}
