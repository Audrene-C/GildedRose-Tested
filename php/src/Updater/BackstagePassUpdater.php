<?php

namespace App\Updater;

use App\InterfaceItem;

class BackstagePassUpdater extends AbstractUpdater implements IUpdater
{

    static function resolve(InterfaceItem $item):bool {
        if($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
            return true;
        } else {
            return false;
        }
    }

    public function update():void {
        // drops to 0 after the sell-by date
        if($this->isExpired()) {
            $this->item->quality = 0;
        }
        // increases by 3 when there are 5 days or less 
        else if($this->item->sell_in <=5) {
            $this->item->quality = $this->item->quality +3 >= 50 ?
            $this->item->quality = 50 : $this->item->quality +3;
        }
        // increases by 2 when there are 10 days or less
        else if($this->item->sell_in <=10) {
            $this->item->quality = $this->item->quality +2 >= 50 ?
            $this->item->quality = 50 : $this->item->quality +2;
        } else {
            $this->item->quality = $this->item->quality +1 >= 50 ?
            $this->item->quality = 50 : $this->item->quality +1;
        }

        $this->updateSellIn();
    }

}
