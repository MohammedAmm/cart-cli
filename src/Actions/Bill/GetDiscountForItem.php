<?php 
namespace Actions\Bill;

use Models\Product;

class GetDiscountForItem
{

    /** @arr ["key"]=>["discount"] */
    private $discount;

    public function execute(Product $product)
    {
        //Get discount by this eq.(count*(price*(discount/100)))
        $this->discount[$product->getName()] = [$product->getDiscount()=>$product->getCount()*($product->getPrice()*($product->getDiscount()/100))];
    
        return $this->discount;
    }
    
}