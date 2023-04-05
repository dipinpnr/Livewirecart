<?php

namespace App\Http\Livewire;
use Illuminate\Support\Arr;
use App\Models\admin\Mst_store_product;
use App\Models\admin\Trn_Cart;
use App\Models\admin\Trn_WishList;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\ParentComponent;
use App\Models\admin\Mst_categories;

class ProductListing extends ParentComponent
{
    public $quantity;
    protected $products=[];
    public $sortBy;
    public $category_id;
    public $categories;
    protected $listeners = [
        'followingRefresh' => '$refresh',
   ];
    public function mount()
    { 
        $this->sortBy="default";
        $this->quantity=[];
        $this->categories=[];
        $this->category_id=[];
       
      
    }
    public function render()
    {
        $this->quantity=[];
        $this->filterProducts();

        //dd($this->quantity[1]);
        foreach($this->products as $product)
        {
            $this->quantity[$product->product_id]=1;
            
            $cart_exist=Trn_cart::where('product_id',$product->product_id)->first();
            if($cart_exist)
            {
                $this->quantity[$product->product_id]=$cart_exist->quantity;

            }
            else
            {
                $this->quantity[$product->product_id]=1;
            }
           
           
        }
        
       $products=$this->products;
       $categories=$this->categories;
       
      
        return view('livewire.product-listing',compact('products'));
    }
    public function addToCart($product_id)
    {
        /*if(!Auth::check()){
            return redirect()->route('test');
        }*/
        //dd($product_id);
        $exist=Trn_cart::where('product_id',$product_id);
        if($exist->exists())
        {
            $cart=$exist->first();
            //dd('exists',$cart->quantity+1);
            $cart->quantity=$cart->quantity+1;
        }
        else
        {
            $cart=new Trn_Cart();
            $cart->quantity=$this->quantity[$product_id];

        }
        $cart->product_id=$product_id;
        $cart->customer_id=100;
        $cart->store_id=100;
        $cart->save();
        $this->emit('cart_updated');
        $this->dispatchBrowserEvent('cart-added',['message'=>'A new item has been added successfully']);
    }
    public function removeFromCart($product_id)
    {
        Trn_cart::where('product_id',$product_id)->delete();
        $this->emit('cart_deleted');
        $this->dispatchBrowserEvent('cart-removed',['message'=>'A new item has been removed']);
    }
    public function updateQuantity($product_id)
    {
        //dd($this->quantity[$product_id]);
        $cart_item=Trn_cart::where('product_id',$product_id)->where('customer_id',100)->first();
        $cart_item->quantity=$this->quantity[$product_id];
        $cart_item->update();
       // $this->emit('followingRefresh'); //emit event
       // $this->dispatchBrowserEvent('cart-added',['message'=>'A new item quantity changed']);
    }
    public function addToWishList($product_id)
    {
        $wl=new Trn_WishList();
        $wl->product_variant_id=$product_id;
        $wl->customer_id=100;
        $wl->save();
        $this->emit('wishlist_updated');
        $this->dispatchBrowserEvent('cart-added',['message'=>'A new item has been added to wishlist successfully']);
    }
    public function removeFromWishList($product_id)
    {
        Trn_WishList::where('product_variant_id',$product_id)->where('customer_id',100)->delete();
        $this->emit('wishlist_deleted');
        $this->dispatchBrowserEvent('cart-removed',['message'=>'An item has been removed fromwishlist']);
    }
    public function filterProducts()
    {

        if($this->sortBy=='default' || $this->sortBy==NULL)
        {
            $prod=Mst_store_product::where('product_type',1);
          
        }
       
        if($this->sortBy=="hl")
            {
                $prod=Mst_store_product::where('product_type',1)->orderBy('product_price','DESC');
                
               
    
            }
        if($this->sortBy=="lh")
            {
                $prod=Mst_store_product::where('product_type',1)->orderBy('product_price','ASC');
               
            }
        
        if(!empty($this->category_id)){
            $filteredCatIds = Arr::where($this->category_id, function ($value, $key) {
                return $value != "false";
            });
            //dd($filteredCatIds);
            if(count(array_unique($filteredCatIds)) != 1)
            {
                $prod->whereIn('product_cat_id',$filteredCatIds);
            }
            //dd($filteredCatIds);
               
           //dd($filteredCatIds);    

        }
            $this->products=$prod->where('product_cat_id','>',0)->paginate(20);
            $this->categories=Mst_categories::get();
            //dd($this->category_id);
            /*foreach($this->categories as $category)
            {
               $this->category_id[$category->category_id]=$category->category_id;
            }*/
      
            
       
       
    }
   
}
