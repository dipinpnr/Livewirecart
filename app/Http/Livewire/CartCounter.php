<?php

namespace App\Http\Livewire;

use App\Models\admin\Trn_Cart;
use App\Models\admin\Trn_WishList;
use Livewire\Component;

class CartCounter extends Component
{
    //public $cart_counter=0;
    protected $listeners=['cart_updated'=>'render','cart_deleted'=>'render','wishlist_updated'=>'render','wishlist_deleted'=>'render'];
    public function render()
    {
        $cart_counter=2;
        //dd($cart_counter);
        $cart_counter=Trn_Cart::where('customer_id',100)->count();
        $wish_counter=Trn_WishList::where('customer_id',100)->count();
        return view('livewire.cart-counter',compact('cart_counter','wish_counter'));
    }
}
