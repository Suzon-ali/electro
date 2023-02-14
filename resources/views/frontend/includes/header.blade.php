<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
            </ul>
            <ul class="header-links pull-right">
                <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                @if (session()->has('userId'))
                <li><a href="{{url('/user-logout')}}"><i class="fa fa-user-o"></i> Logout</a></li>
                @else
                <li><a href="{{url('/login')}}"><i class="fa fa-user-o"></i> Login </a></li>   
                @endif
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{url('/')}}" class="logo">
                            <img src="{{asset('frontend/assets/')}}/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <select class="input-select">
                                
                                <option value="0">All Categories</option>

                                @foreach ($categories as $category)

                                <option value="0">{{$category->name}}</option>
                                    
                                @endforeach
                            </select>
                            <input class="input" placeholder="Search here">
                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>

                            @php
                            $userId = session()->get('userId');
                            $ip_address = request()->ip();
                            @endphp

                             <a href="{{url('/favourite/'.$userId)}}"><i class="fa fa-heart-o"></i><span>Your Wishlist</span>
                                    <div class="qty">{{ \App\Models\Favorite::where('user_id', $userId)
                                        ->orWhere('ip_address', $ip_address)
                                        ->count() }}</div>
                            
                        </div>
                       

                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Your Cart</span>
                                <div class="qty">{{ \App\Models\Cart::where('user_id', $userId)
                                    ->orWhere('ip_address', $ip_address)
                                    ->count() }}</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    @php
                                        $total =0;
                                    @endphp

                                    @foreach ($cartProducts as $product)
                                    <div class="product-widget">
                                        <div class="product-img">
                                            <img src="{{asset('product/'.$product->product->image)}}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h3 class="product-name"><a href="#">{{$product->product->name}}</a></h3>
                                            <h4 class="product-price"><span class="qty">{{$product->qty}}x</span>${{$product->total_price}}</h4>
                                        </div>
                                        <button class="delete"><i class="fa fa-close"></i></button>
                                    </div>

                                    @php
                                        $total += $product->total_price ;
                                    @endphp


                                    @endforeach
                                    
                                    

                                    
                                </div>
                                <div class="cart-summary">
                                    <small>{{ \App\Models\Cart::where('user_id', $userId)
                                        ->orWhere('ip_address', $ip_address)
                                        ->count() }} Item(s) selected</small>
                                    <h5>SUBTOTAL: ${{$total}}</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="#">View Cart</a>
                                    <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->

                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>