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

## Architecture
* Using MVC Design to divide the program logic into three interconnected elements. 
* Model Handle only data.
* Controller Handle only requests and return response.
* Views get data from controller to display.
* Additional layers:
    * User doesn't deal directly with controllers there is a command layer working as dispatcher.
    * Actions to stick to solid principles as much as possible, the program core functionality divider to actions
        each one of them has one thing to do.
    * Services has simple converter to convert currency based on currencies exists on "currencies.json" file.
    * Use json files as database store for simplicity and seperation.

## Steps to run project
* Clone project.
* Composer install
* To use the available command.
    * `php index.php createCart --bill-currency=EGP T-shirt T-shirt shoes`
* To run test cases.
    * `./vendor/bin/phpunit`

## Assumptions
* Our shop decide if you buy item that have both discount and offer, will apply the offer because it has the higher percent.
* For simplicity using json files to store: special offers, products and currencies.
* Application will hult and print message if there any error, instead of raising exception to user, No error handler.
* Models doesn't have validations because the user doesn't deal with it directly should go though actions there the program    validate each part. 
* To stick to solid and return the final output like the given one it took time, the code have many parts to enhance.

## Modifications to handle later
* Add unit tests.
* Drive for DB driver so you can easily switch between available storages.
* The application doesn't have much validation. 


