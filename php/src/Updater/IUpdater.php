<?php

namespace App\Updater;

use App\InterfaceItem;

interface IUpdater
{
    public static function resolve(InterfaceItem $item):bool;
 
    public function updateSellIn():void;
 
    public function update():void;
}