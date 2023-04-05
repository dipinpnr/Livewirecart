<div class="container-fluid">
        <div class="row">
            <aside class="col-lg-9">
                <div class="card">
                <h4>Cart list</h4>
                    <div class="table-responsive">
                        <table class="table table-borderless table-shopping-cart">
                            <thead class="text-muted">
                                <tr class="small text-uppercase">
                                    <th scope="col">Product</th>
                                    <th scope="col" width="120">Quantity</th>
                                    <th scope="col" width="120">Price</th>
                                    <th scope="col" width="100">Total</th>
                                    <th scope="col" class="text-right d-none d-md-block" width="100"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($cart_items as $item)
                                <tr>
                                    <td>
                                        <figure class="itemside align-items-center">
                                            <div class="aside"><img src="https://i.imgur.com/1eq5kmC.png" class="img-sm"></div>
                                            <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">{{$item->product->product_name}}</a>
                                                <p class="text-muted small">SIZE: L <br> Brand: MAXTRA</p>
                                            </figcaption>
                                        </figure>
                                    </td>
                                    <td> <select class="form-control" wire:model="quantity.{{$item->cart_id}}" wire:change="updateQuantity({{$item->cart_id}})">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select> </td>
                                    <td>
                                        <div class="price-wrap"> <var class="price"><i class="fa fa-inr"></i>{{$item->product->product_price}}</var> <small class="text-muted">  </small> </div>
                                    </td>
                                    <td><div class="price-wrap"> <var class="price"><i class="fa fa-inr"></i>{{$item->quantity*$item->product->product_price}}</var> <small class="text-muted">  </small> </td>
                                    <td class="text-right d-none d-md-block"> <a style="display:none;" data-original-title="Save to Wishlist" title="" href="" class="btn btn-light" data-toggle="tooltip" data-abc="true"> <i class="fa fa-heart"></i></a> <a style="text:white;" wire:click="removeFromCart({{$item->cart_id}})" class="btn btn-light text-white" data-abc="true"> Remove</a> </td>
                                </tr>
                                @empty
                                 {{__('No Items Found')}}
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </aside>
            <aside class="col-lg-3">
                <div class="card mb-3">
                    <div class="card-body">
                    @if($coupon_status==0)
                        <form wire:submit.prevent="applyCoupon()">
                            <div class="form-group"> <label>Have coupon?</label>
                                <div class="input-group"> <input type="text" class="form-control coupon" wire:model="coupon_code" placeholder="Coupon code"> <span class="input-group-append"> <button class="btn btn-primary btn-apply coupon">Apply</button> </span> </div>
                            </div>
                        </form>
                        <p  style="color:red;">{{$coupon_status_message}}</p>
                    @else
                    <span class="badge badge-sm badge-success" style="border-style:dotted;"><p>{{$coupon_code}} APPLIED</p></span>
                       <div class="form-group"> <label><a wire:click="removeCoupon()" role="button"><u>Remove coupon</u></a></label></div>
                    @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <dl class="dlist-align">
                            <dt>Total price:</dt>
                            <dd class="text-right ml-3"><i class="fa fa-inr"></i>{{number_format($total_amount,2)}}</dd>
                        </dl>
                       <!-- <dl class="dlist-align">
                            <dt>Discount:</dt>
                            <dd class="text-right text-danger ml-3">- $10.00</dd>
                        </dl>-->
                        <dl class="dlist-align">
                            <dt>Total:</dt>
                            <dd class="text-right text-dark b ml-3"><strong><i class="fa fa-inr"></i>{{number_format($total_amount,2)}}</strong></dd>
                        </dl>
                        <hr> <a href="#" class="btn btn-out btn-primary btn-square btn-main" data-abc="true"> Make Purchase </a> <a href="/" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
