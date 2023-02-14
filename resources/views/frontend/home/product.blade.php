@extends('frontend.master')


@section('content')

<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb-tree">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('/allcategories')}}">All Categories</a></li>
                    <li><a href="{{url('category/' . $product->category->id. '/'.$product->category->slug)}}">{{$product->category->name}}</a></li>
                    <li class="active">{{$product->name}}</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    
                    @foreach ($product->productPhotos as $image)
                    <div class="product-preview">
                        <img src="/public/images/{{$image->images}}" alt="">
                    </div>
                    @endforeach

                    
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2  col-md-pull-5">
                <div id="product-imgs">
                    
                    @foreach ($product->productPhotos as $image)
                    <div class="product-preview">
                        <img src="/public/images/{{$image->images}}" alt="">
                    </div>
                    @endforeach

                    
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{$product->name}}</h2>
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#">10 Review(s) | Add your review</a>
                    </div>
                    @php
                        $price = $product->price;
                        $discountParcentage = $product->discount_percentage;
                        $totalDiscountPercent = $price / 100;
                        $minusPrice = $discountParcentage*$totalDiscountPercent + $price;
                    @endphp
                    <div>
                        <h3 class="product-price">${{$product->price}} 
                            @if ($product->discount_percentage)
                                <del class="product-old-price"> {{$minusPrice}} </del></h3>
                            @endif </h3>
                        <span class="product-available">In Stock</span>
                    </div>
                    <p> {{$product->short_description}}</p>

                    <div class="product-options">
                        <label>
                            Size
                            <select class="input-select">
                                <option value="0">X</option>
                            </select>
                        </label>
                        <label>
                            Color
                            <select class="input-select">
                                <option value="0">Red</option>
                            </select>
                        </label>
                    </div>

                    <div style="display: flex" class="add-to-cart">
                        <div class="qty-label">
                            Qty
                            <div class="input-number">
                                <input type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                        

                        <form action="{{url('add/to/cart')}}" method="post">
                            @csrf
                        
                            <div class="add-to-cart">
                                <input type="hidden" name="product_id" value="{{$product->id}}" id="">
                                <input type="hidden" name="product_price" value="{{$product->price}}" id="">
                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                            </div>
                        
                        </form>
                    </div>

                    @if (in_array($product->id, $productIds))
                                        
                                            <div class="product-btns">
                                                <a style="color: red ; text-decoration:none;" class="add-to-wishlist" class="tooltipp" href="{{url('/remove/from/favorite/'.$product->id)}}">
                                                    <i class="fa fa-heart"></i> <span class="tooltipp">   Remove from Favorite</span></a>
                                                
                                            </div>
                                       
                                        @else
                                        <form action="{{url('/add/to/favorite')}}" method="post">
                                            @csrf
                                            <div class="product-btns">
                                                <input type="hidden" name="product_id" value="{{$product->id}}" id="">
                                                <input type="hidden" name="price" value="{{$product->price}}" id="">
                                                <button type="submit" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">   Add to Favorite</span></button>
                                            </div>
                                        </form>
                                        @endif

                    <ul class="product-links">
                        <li>Category:</li>
                        <li><a href="{{url('category/' . $product->category->id. '/'.$product->category->slug)}}">{{$product->category->name}}</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>

                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab2">Details</a></li>
                        <li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p> {{$product->short_description}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{{strip_tags($product->long_description)}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab2  -->

                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span>4.5</span>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 80%;"></div>
                                                </div>
                                                <span class="sum">3</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <span class="sum">2</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 DEC 2018, 8:0 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="reviews-pagination">
                                            <li class="active">1</li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Reviews -->

                                <!-- Review Form -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        <form class="review-form">
                                            <input class="input" type="text" placeholder="Your Name">
                                            <input class="input" type="email" placeholder="Your Email">
                                            <textarea class="input" placeholder="Your Review"></textarea>
                                            <div class="input-rating">
                                                <span>Your Rating: </span>
                                                <div class="stars">
                                                    <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                </div>
                                            </div>
                                            <button class="primary-btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Review Form -->
                            </div>
                        </div>
                        <!-- /tab3  -->
                    </div>
                    <!-- /product tab content  -->
                </div>
            </div>
            <!-- /product tab -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Related Products</h3>
                </div>
            </div>

            <!-- product -->

            @foreach ($products as $category_product)

            @if($category_product->category->id == $product->category->id  )
            <div class="col-md-3 col-xs-6">
                <div class="product">
                    <div class="product-img">
                        <a href="{{url('product-details/'.$product->id.'/'.$product->name)}}"><img src="{{asset('product/'.$category_product->image)}}" alt=""></a>
                        
                        <div class="product-label">
                            @if ($category_product->discount_percentage)
                            <span class="sale">{{$category_product->discount_percentage}}%</span>
                            @endif
                            
                            @if ($category_product->tag)
                            <span class="new">{{$category_product->tag}}</span>
                            @endif
                        </div>
                    </div>

                                    @php
                                        $price = $product->price;
                                        $discountParcentage = $product->discount_percentage;
                                        $totalDiscountPercent = $price / 100;
                                        $minusPrice = $discountParcentage*$totalDiscountPercent + $price;
                                    @endphp


                    <div class="product-body">
                        <p class="product-category">{{$product->category->name}}</p>
                        <h3 class="product-name"><a href="#">{{$product->name}}</a></h3>
                        <h4 class="product-price">${{$product->price}} 
                        @if ($product->discount_percentage)
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


                        @if (in_array($product->id, $productIds))
                        
                            <div class="product-btns">
                                <a style="color: red ; text-decoration:none;" class="add-to-wishlist" class="tooltipp" href="{{url('/remove/from/favorite/'.$product->id)}}">
                                    <i class="fa fa-heart"></i> <span class="tooltipp">Unfavorite</span></a>
                                
                            </div>
                    
                        @else
                        <form action="{{url('/add/to/favorite')}}" method="post">
                            @csrf
                            <div class="product-btns">
                                <input type="hidden" name="product_id" value="{{$product->id}}" id="">
                                <input type="hidden" name="price" value="{{$product->price}}" id="">
                                <button type="submit" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Add to favorite</span></button>
                            </div>
                        </form>
                        @endif
                    
                        <div class="product-btns">
                            <a style="text-decoration:none;" class="add-to-wishlist" class="tooltipp" href="{{url('product-details/'.$product->id.'/'.$product->name)}}">
                                <i class="fa fa-eye"></i> <span class="tooltipp">Quick View</span></a>
                            
                        </div>
                        
                        
                    </div>
                    
                    </div>
                    <form action="{{url('add/to/cart')}}" method="post">
                        @csrf
                    
                        <div class="add-to-cart">
                            <input type="hidden" name="product_id" value="{{$product->id}}" id="">
                            <input type="hidden" name="product_price" value="{{$product->price}}" id="">
                            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                        </div>
                    
                    </form>
                </div>
            </div>
            @endif
            @endforeach
            
    
            <div class="clearfix visible-sm visible-xs"></div>


        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->

<!-- NEWSLETTER -->
<div id="newsletter" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="newsletter">
                    <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                    <form>
                        <input class="input" type="email" placeholder="Enter Your Email">
                        <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                    </form>
                    <ul class="newsletter-follow">
                        <li>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
    
@endsection