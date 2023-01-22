<?php

namespace App\Http\Livewire\Backend\Pos\Component;

use Livewire\Component;

class CartItem extends Component
{
    public $item,$itemId ;

    public function mount($item, $itemId)
    {
        $this->item= $item;
        $this->itemId= $itemId;
    }

    public function render()
    {
        return view('livewire.backend.pos.component.cart-item');
    }

    public function updateQty($qty,$itemId)
    {
        $this->emit('updateQty',$qty, $itemId);
    }
}
