<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                <li class="{{Request::is('/') ? 'active' : '' }}"><a href="{{url('/')}}">Home</a></li>
                @foreach ($categories as $category)

                <li class="{{ Request::is('category/' . $category->id . '/' . $category->slug) ? 'active' : '' }}" ><a href="{{ url('category/' . $category->id. '/'.$category->slug)}}">{{$category->name}}</a></li>
                    
                @endforeach
                
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>