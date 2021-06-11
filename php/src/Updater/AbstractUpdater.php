<?php

namespace App\Updater;

use App\InterfaceItem;

abstract class AbstractUpdater implements IUpdater
{
    protected InterfaceItem $item;

    function __construct(InterfaceItem $item)
    {
        $this->item = $item;
    }

    abstract public static function resolve(InterfaceItem $item):bool;

   protected function isExpired():bool
    {
        return $this->item->sell_in <= 0;
    }

    public function updateSellIn():void
    {
        $this->item->sell_in = $this->item->sell_in -1;
    }

   abstract public function update():void;
}