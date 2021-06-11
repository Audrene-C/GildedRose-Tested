<?php

declare(strict_types=1);

namespace Tests;

use App\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    public function testItemName(): void
    {
        $item = new Item('Elixir of the Mongoose', 5, 3);
        $this->assertSame('Elixir of the Mongoose', $item->name);
    }

    public function testItemSell_in(): void
    {
        $item = new Item('Elixir of the Mongoose', 5, 3);
        $this->assertSame(5, $item->sell_in);
    }

    public function testItemQuality(): void
    {
        $item = new Item('Elixir of the Mongoose', 5, 3);
        $this->assertSame(3, $item->quality);
    }

    public function testItemToString(): void
    {
        $item = new Item('Elixir of the Mongoose', 5, 3);
        $this->assertSame("Elixir of the Mongoose, 5, 3", $item->__toString());
    }
}
