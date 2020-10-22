<?php 
namespace Actions\Bill;

class GetAllDiscounts
{
    /** @arr [["key"]=>["discount"],...] */
    private $discounts=[];

    /** @action GetDiscountForItem */
    private $action;

    public function __construct()
    {
        $this->action = new GetDiscountForItem();
    }

    public function execute(array $products)
    {
        foreach ($products as $product) {
            if ($product->getDiscount()!=0) {
                //Get discount for each product if first time init array if second push to the same array.
                if (empty($this->discounts)) {
                    $this->discounts= $this->action->execute($product);
                    break;
                }
                array_push($this->discounts, $this->action->execute($product));
            }
        }
        return $this->discounts;
    }
    
}