<?php
namespace Views;

class BillView
{
    private $currencyArr;

    public function output(array $data)
    {
        $this->currencyArr=$data["CurrencyArr"];

        print "Subtotal: ".$this->textDecorate($data["Subtotal"])."\n";
        print "Taxes: ".$this->textDecorate($data["Taxes"])."\n";
        if ($this->checkDiscountsToDisplay($data["Discounts"])) {
            print "Discounts:\n";
            foreach ($data["Discounts"] as $outerKey => $array) {
                foreach ($array as $key => $value) {
                    print "\t".$key."% off ".lcfirst($outerKey).": -".$this->textDecorate($value). "\n";
                }
            }
            
        }
        print "Total: ".$this->textDecorate($data["Total"])."\n";
        return;
    }
    //To be extracted to external action or decorator
    private function checkDiscountsToDisplay(array $discounts): bool
    {
        return !empty($discounts);
    }
    
    private function textDecorate(float $number):string
    {
        return $this->currencyArr['direction'] == 'l' ? ("".$this->currencyArr['symbol'].$number):$number." ".$this->currencyArr['symbol'];
    }
}
