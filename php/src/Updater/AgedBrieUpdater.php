<?php

namespace App\Updater;
use App\InterfaceItem;

class AgedBrieUpdater extends AbstractUpdater implements IUpdater
{

    public static function resolve(InterfaceItem $item):bool {
        if($item->name === "Aged Brie") {
            return true;
        }
        return false;
    }

    public function update():void {
        // +2 per day after the sell-by date
        if($this->isExpired()) {
            $this->item->quality = $this->item->quality +2 >= 50 ?
            $this->item->quality = 50 : $this->item->quality +2;
        } else {
            $this->item->quality = $this->item->quality +1 >= 50 ?
            $this->item->quality = 50 : $this->item->quality +1;
        }

        $this->updateSellIn();
    }
}
