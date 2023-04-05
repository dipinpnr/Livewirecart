<div class="col-md-12">
<div class="row">
<div class="col-md-4">
 <div class="card card-body mt-3">
 --Filter Category--


 @foreach($categories as $category)
 <label for="cat{{$category->category_id}}">{{$category->category_name}}</label>
 <input type="checkbox" name="category_id" id="cat{{$category->category_id}}" wire:model="category_id.{{$category->category_id}}" value="{{$category->category_id}}">
 <br>
 @endforeach
 </div>
</div>
<div class="col-md-8">
@php
//dd($quantity[1]);
@endphp
<select  wire:model="sortBy">
<option value="default" >No Sort</option>
<option value="lh" >Price(Lower To Higher)</option>
<option value="hl">Price(Higher To Lower)</option>
</select>

{{__('Show Results For')}}

            @foreach($products as $product)
                <div class="card card-body mt-3">
                            <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                                <div class="mr-2 mb-3 mb-lg-0">
                                    
                                        <img src="https://i.imgur.com/5Aqgz7o.jpg" width="150" height="150" alt="">
                                   
                                </div>

                                <div class="media-body">
                                    <h6 class="media-title font-weight-semibold">
                                        <a href="#" data-abc="true">{{$product->product_name}}</a>
                                    </h6>

                                    <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Phones</a></li>
                                        <li class="list-inline-item"><a href="#" class="text-muted" data-abc="true">Mobiles</a></li>
                                    </ul>

                                    <p class="mb-3">128 GB ROM | 15.49 cm (6.1 inch) Display 12MP Rear Camera | 7MP Front Camera A12 Bionic Chip Processor | Gorilla Glass with high quality display </p>

                                    <ul class="list-inline list-inline-dotted mb-0">
                                    @php
                                       $wishExist=App\Models\admin\Trn_WishList::where('customer_id',100)->where('product_variant_id',$product->product_id)->exists();
                                    @endphp
                                    @if($wishExist)
                                      <li class="list-inline-item"> <a  wire:click="removeFromWishList({{$product->product_id}})" data-abc="true"><i class="far fa-heart"></i></a></li>
                                    @else
                                        <li class="list-inline-item"><a  wire:click="addToWishList({{$product->product_id}})" data-abc="true"><i class="far fa-heart-o"></i></a></li>
                                    @endif
                                    </ul>
                                </div>

                                <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                                    <h3 class="mb-0 font-weight-semibold"><i class="fa fa-inr"></i>{{$product->product_price}}</h3>

                                    <div>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>

                                    </div>

                                    <div class="text-muted">1985 reviews</div>
                                    <form wire:submit.prevent="addToCart({{$product->product_id}})">
                                   
                                   
                                     @php
                                      $exist_in_cart=\App\Models\admin\Trn_cart::where('product_id',$product->product_id)->exists();
                                     @endphp
                                     @if($exist_in_cart)
                                     <div class="quantity">
                                     {{--<input type="number" wire:model="quantity.{{$product->product_id}}"  wire:change="updateQuantity({{$product->product_id}})"  min="1" max="4">  --}}  
                                     <button type="submit" class="btn btn-warning mt-4 text-white"><i class="icon-cart-add mr-2"></i> Add to cart</button> 
                                     </div>    
                                     @else
                                    <button type="submit" class="btn btn-warning mt-4 text-white"><i class="icon-cart-add mr-2"></i> Add to cart</button>
                                    @endif
                                    </form>
                                </div>
                            </div>
                        </div>
            @endforeach
              <div class="card-footer float-right">{{$products->links()}}</div>
                             
</div>
</div>       
</div>  