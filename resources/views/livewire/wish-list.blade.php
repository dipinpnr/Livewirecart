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
                                    <th scope="col" width="120">Price</th>
                                    <th scope="col" class="text-right d-none d-md-block" width="100"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($wish_items as $item)
                                <tr>
                                    <td>
                                        <figure class="itemside align-items-center">
                                            <div class="aside"><img src="https://i.imgur.com/1eq5kmC.png" class="img-sm"></div>
                                            <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">{{$item->productVariantData->product_name}}</a>
                                                <p class="text-muted small">SIZE: L <br> Brand: MAXTRA</p>
                                            </figcaption>
                                        </figure>
                                    </td>
                                   
                                    <td>
                                        <div class="price-wrap"> <var class="price"><i class="fa fa-inr"></i>{{$item->product->product_price}}</var> <small class="text-muted">  </small> </div>
                                    </td>
                                   
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
            
        </div>
    </div>
