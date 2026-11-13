<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class StockCalculationTest extends TestCase
{
    public function test_remaining_stock_calculation(): void
    {
        $initialCapacity = 500;
        $soldCount = 120;
        $remainingStock = $initialCapacity - $soldCount;

        $this->assertEquals(380, $remainingStock);
    }

    public function test_sold_percentage_calculation(): void
    {
        $initialCapacity = 1000;
        $soldCount = 450;
        $percentage = round(($soldCount / $initialCapacity) * 100);

        $this->assertEquals(45, $percentage);
    }

    public function test_capacity_reduction_validation_logic(): void
    {
        $soldCount = 50;
        $newCapacityAttempt = 40;

        $isValid = $newCapacityAttempt >= $soldCount;
        $this->assertFalse($isValid, 'New capacity cannot be smaller than sold tickets.');
    }
}
