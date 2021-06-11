<?php

namespace App;
use App\Item;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items = [];
    private IUpdaterFactory $factory;

    public function __construct($items, IUpdaterFactory $factory)
    {
        $this->items = $items;
        $this->factory = $factory;
    }

    public function updateItem($item):void
    {
        $updater = $this->factory->build($item);
        $updater->update();
    }

    public function updateQuality():void
    {
        foreach ($this->items as $item) {
            $this->updateItem($item);
        }
    }
}
