<?php

namespace Tests\Feature;

use Commands\CreateCart;
use PHPUnit\Framework\TestCase;

class CreateCartCommand extends TestCase
{
    /** @test */
    public function can_execute_command()
    {

        $command = new CreateCart();
        $output = $command->handle(["php", "createCart", "--bill-currency=EGP", "T-shirt", "T-shirt", "shoes"]);
        $this->assertContains($output,"Subtotal");
    }
}
