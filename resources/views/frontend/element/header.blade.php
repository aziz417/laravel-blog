<header>
	<div class="container-fluid position-relative no-side-padding">

		<a href="{{ route('home') }}" class="logo"><img src="{{ asset('frontend/images/logo.png') }}" alt="Logo Image"></a>

		<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

		<ul class="main-menu visible-on-click" id="main-menu">
			<li><a href="{{ route('home') }}">Home</a></li>
			<li><a href="{{ route('all.posts') }}">All Posts</a></li>

<li>
  <a>Categories</a>
</li>


            @if(Auth::check())
                <li><a href="{{ route('login') }}">Dashboard</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById
                            ('logout-form').submit();">
                    Logout</a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                        @csrf
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
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
