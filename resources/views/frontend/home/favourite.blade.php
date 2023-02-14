@extends('frontend.master')

@section('title')
    Electro | Favourite list
@endsection

@section('content')
    
<div style="width: 100%; height:auto; display:flex; aling-items:center; justify-content:center;">

    <div style="padding:50px" class="container">

        <div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Your Favorite list</h3>
							
						</div>
					</div>
					<!-- /section title -->

                    <div class="col-md-12  " id="new_product_all_showall">
                        <div class="row">
                            <div class="products-tabs">
                                <!-- tab -->
                                <div id="tab1" class="tab-pane active">
                                    <div class="products-slick" data-nav="#slick-nav-1">
                                        <!-- product -->
        
                                        @foreach ($favourites as $favourite)

                                        <div class="product">
                                            <div class="product-img">
                                                <a href="{{url('product-details/'.$favourite->product->id.'/'.$favourite->product->name)}}"><img style="" src="{{asset('product/'.$favourite->product->image)}}" alt="" ></a>
                                                
                                                <div class="product-label">
                                                    @if ($favourite->product->discount_percentage)
                                                    <span class="sale">{{$favourite->product->discount_percentage}}%</span>
                                                    @endif
                                                    
                                                    @if ($favourite->product->tag)
                                                    <span class="new">{{$favourite->product->tag}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @php
                                                $price = $favourite->product->price;
                                                $discountParcentage = $favourite->product->discount_percentage;
                                                $totalDiscountPercent = $price / 100;
                                                $minusPrice = $discountParcentage*$totalDiscountPercent + $price;
                                            @endphp
                                            <div class="product-body">
                                                <p class="product-category">{{$favourite->product->category->name}}</p>
                                                <h3 class="product-name"><a href="#">{{$favourite->product->name}}</a></h3>
                                                <h4 class="product-price">${{$favourite->product->price}} 
                                                @if ($favourite->product->discount_percentage)
                                                    <del class="product-old-price"> {{$minusPrice}} </del></h4>
                                                @endif </h4>
                                                <div class="product-rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
        
                                               <div class="flex justify-center">
                                                <div class="product-btns">
                                                    <a style="color: red ; text-decoration:none;" class="add-to-wishlist" class="tooltipp" href="{{url('/remove/from/favorite/'.$favourite->product->id)}}">
                                                        <i class="fa fa-heart"></i> <span class="tooltipp">Unfavorite</span></a>
                                                    
                                                </div>
                                                <form action="{{url('/quick/view')}}" method="post">
                                                    @csrf
                                                    <div class="product-btns">
                                                        
                                                            <input type="hidden" name="product_id" value="{{$favourite->product->id}}" id="">
                                                            <input type="hidden" name="price" value="{{$favourite->product->price}}" id="">
                                                            <button type="submit" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Quick View</span></button>
                                                    
                                                    </div>
                                                </form>
                                               </div>
                                              
                                            </div>
                                            <form action="{{url('add/to/cart')}}" method="post">
                                                @csrf
                                            
                                                <div class="add-to-cart">
                                                    <input type="hidden" name="product_id" value="{{$favourite->product->id}}" id="">
                                                    <input type="hidden" name="product_price" value="{{$favourite->product->price}}" id="">
                                                    <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                                </div>
                                            
                                            </form>
                                        </div>
                                        
        
                                        @endforeach
        
                                        <!-- /product -->
                                    </div>
                                    <div id="slick-nav-1" class="products-slick-nav"></div>
                                </div>
                                <!-- /tab -->
                            </div>
                        </div>
                    </div>


                    
						
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
      
    </div>

</div>


@endsection