<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Services\Converter\Actions\Convert;

class ConvertTest extends TestCase
{
    /** @test */
    public function can_convert_from_usd_to_any_currency_in_store()
    {
        $convertObject = new Convert("EGP");
        $convertedEgp = $convertObject->excute(10);
        $this->assertEquals($convertedEgp, 157);

    }
}
