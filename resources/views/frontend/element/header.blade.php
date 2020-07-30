<header>
	<div class="container-fluid position-relative no-side-padding">

		<a href="{{ route('home') }}" class="logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="Logo Image"></a>

		<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

		<ul class="main-menu visible-on-click" id="myDIV">
			<li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
			<li class="{{ Request::is('all*') || Request::is('post*') ? 'active' : '' }}"><a href="{{ route('all.posts') }}">All Posts</a></li>
            <li class="category_list btn1 {{ Request::is('category*') ? 'active' : '' }}"><a>Categories</a>
               <div class="category_items">
                   <ul>
                       @foreach($categories as $category)
                            <li><a href="{{ route('category.post', [ 'category' => $category->slug, 'id' =>$category->id ] ) }}"><b>{{ $category->name }}</b></a></li>
                       @endforeach
                   </ul>
               </div>
            </li>
            @if(Auth::check())
                <li class=""><a href="{{ route('login') }}">Dashboard</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById
                            ('logout-form').submit();">
                    Logout</a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                        @csrf
                    </form>
                </li>
            @else
                <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{ route('login') }}">Login</a></li>
                <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="{{ route('register') }}">Register</a></li>
            @endif

		</ul><!-- main-menu -->

		<div class="src-area">
			<form action=" {{ route('search') }} " method="get">
				<button class="src-btn"  type="submit"><i class="ion-ios-search-strong"></i></button>
				<input class="src-input" value="{{ isset($key) ? $key: '' }}" name="search" type="text" placeholder="Type of search">
			</form>
		</div>
	</div><!-- conatiner -->
</header>

@push('js')
    <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("myDIV");
        var btns = header.getElementsByClassName("btn");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    </script>
@endpush



