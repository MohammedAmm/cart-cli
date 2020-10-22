<?php

namespace Tests\Unit\Models;

use Models\Offer;
use PHPUnit\Framework\TestCase;

class OfferModelTest extends TestCase
{
    /** @test */
    function can_get_all_offers_from_store()
    {
        $offers = Offer::getStock();
        $this->assertNotEmpty($offers);
    }
}