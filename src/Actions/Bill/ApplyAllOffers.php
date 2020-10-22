<?php
namespace Actions\Bill;

use Models\Product;

class ApplyAllOffers
{
    /** @arr [["key"]=>["discount"],...] */
    private $discounts = [];

    /** @action  */
    private $action;

    public function __construct()
    {
        $this->action = new GetAllOffers();
    }

    public function execute(array $products, $discounts)
    {
        $this->initDiscunts($discounts);
        //Get all limited offers
        $limitedOffers=$this->action->execute($products);

        //Apply offer if item exists in cart.
        foreach ($limitedOffers as $itemName => $limitedOfferArray) {
            if (isset($products[$itemName])) {
                $product = $products[$itemName];
                $applyOnLimitedNumber = $this->numberOfOffersToApply($product, $limitedOfferArray);
                $this->initItemIfNotExists($itemName);
                $this->discounts[$itemName] = [$limitedOfferArray["percent"]=>$applyOnLimitedNumber * ($product->getPrice() * ($limitedOfferArray["percent"] / 100))];
            }

        }
        return $this->discounts;
    }

    private function numberOfOffersToApply(Product $product, array $limitedOfferArray)
    {
        //If user bought 3 offers and he would get 3 discounts but he want only 2 return with 2
        //If user bought 3 offers and he would get 3 discounts but he want only 4 return with 3
        return $limitedOfferArray["number"] > ($itemCount = $product->getCount()) ? $itemCount : $limitedOfferArray["number"];
    }
    public function initDiscunts(array $discounts)
    {
        //Init with default discounts that exists for each items
        $this->discounts = $discounts;
    }

    private function initItemIfNotExists($itemName)
    {
        //If the item doesn't exist init with 0 to add discounts on it.
        if (!isset($this->discounts[$itemName])) {
            $this->discounts[$itemName] = 0;
        }
    }
}
