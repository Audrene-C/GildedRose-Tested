<?php

namespace App;

use App\InterfaceItem;

interface IUpdaterFactoryRegistry
{
    public function resolve(InterfaceItem $item):string;

    public function register(string $updater): void;
}