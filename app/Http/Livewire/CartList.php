<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\CustomerCoupon;
use App\Models\admin\Trn_Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartList extends Component
{
    protected $listeners=['cart_updated'=>'render','cart_deleted'=>'render'];
    public $cart_items=[];
    public $quantity=[];
    public $sub_total_amount;
    public $total_amount;
    public $line_total=[];
    public $coupon_code;
    public $coupon_status;
    public $coupon_status_message;
    

    public function mount()
    {
     
        $this->total_amount=0;
        $this->coupon_status_message='';
        $this->coupon_status=0;
        $this->cart_items=Trn_Cart::with('product')->where('customer_id',100)->get();
        foreach($this->cart_items as $item)
        {
          $this->quantity[$item->cart_id]=$item->quantity;
          
        }
       $this->getTotalAmount();
    //dd($this->total_amount);
    }
    public function getTotalAmount()
    {
        $this->sub_total_amount=0;
        $this->total_amount=0;
        $this->cart_items=Trn_Cart::with('product')->where('customer_id',100)->get();
        foreach($this->cart_items as $item)
        {
            $this->sub_total_amount+=$item->product->product_price*$item->quantity;
            $this->line_total[$item->cart_id]=$item->product->product_price*$item->quantity;


        }
       $this->total_amount=$this->sub_total_amount;
    }
    public function updateQuantity($cart_id)
    {
      //dd($this->quantity[$cart_id]);
      $cart=Trn_Cart::findOrFail($cart_id);
      $cart->quantity=$this->quantity[$cart_id];
      $cart->update();
      //dd($this->quantity[$cart_id]);
      $this->emit('cart_updated');
      $this->getTotalAmount();
    }
    public function render()
    {
        return view('livewire.cart-list');
    }
    public function removeFromCart($cart_id)
    {
        //dd($cart_id);
        Trn_cart::findOrFail($cart_id)->delete();
        $this->emit('cart_deleted');
        $this->getTotalAmount();
        $this->dispatchBrowserEvent('cart-removed',['message'=>'A new item has been removed']);
    }
    public function applyCoupon()
    {
        //$this->total_amount=$this->getTotalAmount();
      //return $total_amount;
      //dd($this->coupon_code);
      $coupon=Coupon::where('coupon_code',$this->coupon_code);
      
      if(is_null($coupon->first()))
      {
        $this->coupon_status_message="Invalid coupon code";
       //return response()->json(['status'=>7,'message'=>'Invalid coupon code','total_rate'=>$total_amount]);
      }
      else
      {
        if(date('Y-m-d')>$coupon->first()->end_date)
        {
            $this->coupon_status_message="Coupon Expired";
            $this->coupon_status=0;
            return 0;
          //return response()->json(['status'=>5,'message'=>'Coupon Expired','total_rate'=>$total_amount]);
        }
        if($coupon->first()->minimum_order_amount>=$this->total_amount)
        {
          $this->coupon_status_message="Not Applicable to current amount";
          $this->coupon_status=0;
          return 0;
          //return response()->json(['status'=>6,'message'=>'Not Applicable to current amount','total_rate'=>$total_amount]);
        }
    
      $customer_coupon=CustomerCoupon::where('customer_id',100)->where('coupon_id',$coupon->first()->id);
      if($customer_coupon->exists())
      {
        $this->coupon_status_message="You can not apply this coupon code.This coupon already applied before";
        $this->coupon_status=0;
        return 0;
        //return response()->json(['status'=>1,'message'=>'You can not apply this coupon code.This coupon already applied before','total_rate'=>$total_amount]);
      }
      else
      {
       
      
            $customer_coupon=new CustomerCoupon();
            $customer_coupon->coupon_id=@$coupon->first()->id;
            $customer_coupon->customer_id=100;
            $customer_coupon->is_applied=1;
            $customer_coupon->save();
            if($coupon->first()->discount_type==1)
            {
                $this->total_amount=$this->total_amount-$coupon->first()->discount_value;
            }
            if($coupon->first()->discount_type==2)
            {
                $this->total_amount=$this->total_amount-($this->total_amount*$coupon->first()->discount_value)/100;
            }
            $this->coupon_status_message="Coupon code applied successfully";
            $this->coupon_status=1;

        }
      
        //return response()->json(['status'=>2,'message'=>'Coupon code applied successfully','total_rate'=>number_format($total_amount_applied,2),]);
      }
      
     
    
            
       
    }
    public function removeCoupon()
    {
        //dd($cart_id);
        $coupon=Coupon::where('coupon_code',$this->coupon_code)->first();
        CustomerCoupon::where('customer_id',100)->where('coupon_id',$coupon->id)->delete();
        $this->emit('coupon_removed');
        $this->coupon_status=0;
        $this->coupon_status_message="";
        $this->coupon_code="";
        $this->getTotalAmount();
        $this->dispatchBrowserEvent('cart-removed',['message'=>'Coupon has been removed']);
    }
    
   
}

