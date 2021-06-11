<?php

declare(strict_types=1);

namespace Tests;

use App\GildedRose;
use App\Item;
use App\UpdaterFactoryRegistry;
use PHPUnit\Framework\TestCase;
use App\Updater\AgedBrieUpdater;
use App\Updater\BackstagePassUpdater;
use App\Updater\ConjuredItemUpdater;
use App\Updater\ItemUpdater;
use App\Updater\SulfurasUpdater;
use App\UpdaterFactory;

//un fichier par classe
class GildedRoseTest extends TestCase
{

    public function provider() {
    	return array(
    		['+5 Dexterity Vest', 10, 20, '+5 Dexterity Vest, 9, 19'],
            ['Aged Brie', 2, 0, 'Aged Brie, 1, 1'],
            ['Elixir of the Mongoose', 5, 7, 'Elixir of the Mongoose, 4, 6'],
            ['Sulfuras, Hand of Ragnaros', 0, 80, 'Sulfuras, Hand of Ragnaros, 0, 80'],
            ['Sulfuras, Hand of Ragnaros', -1, 80, 'Sulfuras, Hand of Ragnaros, -1, 80'],
            ['Backstage passes to a TAFKAL80ETC concert', 15, 20, 'Backstage passes to a TAFKAL80ETC concert, 14, 21'],
            ['Backstage passes to a TAFKAL80ETC concert', 10, 49, 'Backstage passes to a TAFKAL80ETC concert, 9, 50'],
            ['Backstage passes to a TAFKAL80ETC concert', 5, 49, 'Backstage passes to a TAFKAL80ETC concert, 4, 50'],
            ['Conjured Mana Cake', 3, 6, 'Conjured Mana Cake, 2, 5']
    	);
    }

    /**
     * @dataProvider provider
     */
    public function testGildedRoseUpdateQuality($name, $sell_in, $quality, $expected): void
    {
        $item = new Item($name, $sell_in, $quality);
        $registry = new UpdaterFactoryRegistry();
        $registry->register(AgedBrieUpdater::class);
        $registry->register(BackstagePassUpdater::class);
        $registry->register(ConjuredItemUpdater::class);
        $registry->register(SulfurasUpdater::class);
        $registry->register(ItemUpdater::class);
        $factory = new UpdaterFactory($registry);
        $gildedRose = new GildedRose([$item], $factory);
        $gildedRose->updateQuality([$item]);

        $this->assertSame($expected, $item->__toString());
        $this->assertSame($expected, $item->__toString());
        $this->assertSame($expected, $item->__toString());
        $this->assertSame($expected, $item->__toString());
        $this->assertSame($expected, $item->__toString());
        $this->assertSame($expected, $item->__toString());
        $this->assertSame($expected, $item->__toString());
        $this->assertSame($expected, $item->__toString());
        $this->assertSame($expected, $item->__toString());
    }
}
