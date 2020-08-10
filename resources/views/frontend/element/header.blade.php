<header id="header">
	<div id="navbar" class="container-fluid position-relative no-side-padding">

        <a id="logo" href="{{ route('home') }}" class="logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="Logo Image"></a>

		<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

		<ul class="main-menu visible-on-click" id="myDIV">
			<li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
			<li class="{{ Request::is('all*') || Request::is('post*') ? 'active' : '' }}"><a href="{{ route('all.posts') }}">All Posts</a></li>
            <li onclick="myFunction()" class="category_list {{ Request::is('category*') ? 'active' : '' }}"><a href="javascript:void(0);">Categories</a>
               <div id="myDIV" class="category_items">
                   <ul>
                       @foreach($categories as $category)
                            <li><a href="{{ route('category.post', [ 'category' => $category->slug, 'id' =>$category->id ] ) }}"><b>{{ $category->name }}</b></a></li>
                       @endforeach
                   </ul>
               </div>
            </li>
            @if(Auth::check())
                <li><a id="scrol-small" href="{{ route('login') }}">Dashboard</a></li>
                <li>
                    <a id="scrol-small" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById
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
            <form action="{{ route('search') }}" method="get">
                @csrf
				<button class="src-btn"  type="submit"><i class="ion-ios-search-strong"></i></button>
				<input autocomplete="off" id="search" onkeyup="getSuggestion(this)" class="src-input" value="{{ isset($key) ? $key: '' }}" name="search" type="text" placeholder="Type of search">
            </form>
		</div>
	</div><!-- conatiner -->
</header>

<div id="show-suggestion" class="autocomplete-result hidden">

</div>

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <script type="text/javascript" charset="utf-8">

        function myFunction() {
            var element = document.getElementById("myDIV");
            element.classList.add("mystyle");
            element.classList.remove("category_items");
        }


        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
                document.getElementById("header").style.opacity = "0.8";
            } else {
                document.getElementById("header").style.opacity = "1";
            }
        }

    </script>
@endpush



