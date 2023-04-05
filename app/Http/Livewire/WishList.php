<?php

namespace App\Http\Livewire;

use App\Models\admin\Trn_WishList;
use Livewire\Component;

class WishList extends Component
{
    public function mount()
    {
        
        $this->wish_items=Trn_WishList::with('productVariantData')->where('customer_id',100)->get();
    //dd($this->total_amount);
    }
    public function render()
    {
        return view('livewire.wish-list');
    }
}
