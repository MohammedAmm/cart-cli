<?php 
namespace Actions\Bill;

use Models\Offer;

class GetAllOffers
{
    /** @arr [["name"]=>["number","percent"],...] */
    private $limitedOffers;

    public function __construct()
    {
    }

    public function execute(array $products)
    {
        foreach (Offer::getStock() as $offer) {
            if (array_key_exists($offer["item_name"],$products)//check if limited offer exists in cart
            && $products[$offer["item_name"]]->getCount()>=$offer["item_count"]) {//Check count of items to apply offer.
                $offersCount=$this->getOffersCount($products[$offer["item_name"]],$offer["item_count"]);
                //Sale on item if user buy the target(in offer) 
                $this->limitedOffers[$offer["apply_on_item"]]=["number"=>$offersCount,"percent"=>$offer["apply_percent"]];
            }
        }
        return $this->limitedOffers;
    }

    public function getOffersCount($product, $itemTarget)
    {
        //Calculate how many offers should apply bassed on number of items user buy divided by number of items should buy.
        return floor($product->getCount()/$itemTarget);
    }
    
}