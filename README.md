## Cart-CLI
This simple project you can use to excute simple command to add items to cart and return total price with currency
based on user choice.

## Basic Concept
* Create command and get data from it.
* Create cart.
* Add items to cart.
* Retrieve cart.
* Calculate subtotal, taxes, discounts including offers and total.
* Return required format and handle direction.


## Steps to run project
* Clone project.
* Composer install
* To use the available command.
    * `php index.php createCart --bill-currency=EGP T-shirt T-shirt shoes`

## Assumptions
* Our shop decide if you buy item that have both discount and offer, will apply the offer because it has the higher percent.
* For simplicity using json files to store: special offers, products and currencies.

## Modifications to handle later
* Add unit tests.
* Drive for DB driver so you can easily switch between available storages.
* The application doesn't have much validation. 


