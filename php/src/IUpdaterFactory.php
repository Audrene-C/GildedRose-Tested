<?php

namespace App;
use App\InterfaceItem;
use App\Updater\IUpdater;

interface IUpdaterFactory
{
    public function build(InterfaceItem $item):IUpdater;
}