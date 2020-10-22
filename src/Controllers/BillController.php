<?php
namespace Controllers;

use Views\BillView;
use Actions\Bill\GetTotalBillValues;
use Models\Cart;

class BillController
{
    /**
     * @var [View]
     */
    private $view;
    /**
     * @var [Action]
     */
    private $getTotalBillValues;

    public function __construct()
    {
        $this->view = new BillView();
        $this->getTotalBillObject = new GetTotalBillValues();

    }

    public function create(Cart $cart)
    {
        
        //Get request
        $data = $this->getTotalBillObject->execute($cart);

        //Handle Response
        $this->view->output($data);
    }
}
