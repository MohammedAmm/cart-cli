<?php
namespace Actions\Bill;

use Models\Cart;
use Services\Converter\Actions\Convert;
use Services\Converter\Actions\GetConvertDetails;

class GetTotalBillValues
{

    /** @arr ["key"]=>["discount"] */
    private $discount;
    /** @action  GetSubTotal */
    private $subTotalObject;
    /** @action  CalculateTotalTaxes */
    private $taxesObject;
    /** @action  GetAllDiscounts */
    private $discountsObject;
    /** @action  ApplyAllOffers */
    private $offersObject;
    /** @action  GetConvertDetails */
    private $converDetailsObject;
    /** @action   */
    private $convertObject;

    public function __construct()
    {
        $this->subTotalObject = new GetSubTotal();
        $this->taxesObject = new CalculateTotalTaxes();
        $this->discountsObject = new GetAllDiscounts();
        $this->offersObject = new ApplyAllOffers();
        $this->converDetailsObject = new GetConvertDetails();
    }
    public function execute(Cart $cart)
    {
        //Get Products within cart
        $cartProducts = $cart->get();
        //Get subtotal of all products within cart before taxes and discounts
        $subTotal = $this->subTotalObject->execute($cartProducts);
        //Get taxes for all items.
        $totalTaxes = $this->taxesObject->execute($subTotal);
        //Get All Discounts
        $discounts = $this->discountsObject->execute($cartProducts);
        //Get All Discounts with limited offers
        $discountsWithOffers = $this->offersObject->execute($cartProducts, $discounts);
        //TotalPrice include taxes and discounts
        $totalDiscounts = $this->sumTotalDiscounts($discountsWithOffers);
        $totalPrice = $this->calculateTotalValues($subTotal, $totalTaxes, $totalDiscounts);
        $currencyArray = $this->converDetailsObject->excute($cart->getCurrency());
        //Check if need to convert values
        if ($cart->getCurrency() == 'USD') {
            return ["Subtotal" => $subTotal, "Taxes" => $totalTaxes, "Discounts" => $discountsWithOffers, "Total" => $totalPrice, "CurrencyArr" => $currencyArray];
        }
        $this->convertObject = new Convert($cart->getCurrency());
        return ["Subtotal" => $this->convertObject->excute($subTotal),
            "Taxes"            => $this->convertObject->excute($totalTaxes),
            "Discounts"        => $this->modifyDiscount($discountsWithOffers),
            "Total"            => $this->convertObject->excute($totalPrice),
            "CurrencyArr"      => $currencyArray];

    }

    private function calculateTotalValues(float $subTotal, float $totalTaxes, float $totalDiscounts): float
    {
        return $subTotal + $totalTaxes - $totalDiscounts;
    }

    private function sumTotalDiscounts(array $discounts): float
    {
        //Work around to get calculate percent.
        $result = 0;
        foreach ($discounts as $discount) {
            foreach ($discount as $discount) {
                $result += $discount;
            }
        }
        return $result;
    }
    private function modifyDiscount(array $discountsWithOffers): array
    {
        $result = [];
        foreach ($discountsWithOffers as $name => $discount) {
            $key=array_keys($discount);
            $value=array_values($discount);
            $discount[$key[0]]=$this->convertObject->excute($value[0]);
            $result[$name]=$discount;
        }
        return $result;
    }

}
