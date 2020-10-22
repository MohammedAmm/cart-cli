
<?php
/*
 */

use Commands\CreateCart;

require "vendor/autoload.php";

$command=new CreateCart();
$command->handle($argv);