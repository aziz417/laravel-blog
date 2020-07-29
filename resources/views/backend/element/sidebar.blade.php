<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" style="width: 60px; height: 50px" class="img-circle" src="{{ Storage::disk('public')->url('profile/').Auth::user()->image }}" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                @if(Auth::user()->role_id == 1)
                                    <li><a href="{{ route('admin.admin.edit') }}">Admin Profile</a></li>
                                @else
                                    <li><a href="{{ route('author.author.edit') }}">Author Profile</a></li>
                                @endif
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
                                <li><a
                                    onclick="
                                        event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                     href="{{ route('logout') }}">Logout</a>
                                     <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none">
                                        @csrf
                                     </form></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>

                    <!--admin menu list-->
                    @if(Request::is('admin*'))
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Frontend</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/tags*') ? 'active' : '' }}">
                            <a  href="{{ route('admin.tags.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Tages</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                            <a  href="{{ route('admin.categories.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Categories</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                            <a  href="{{ route('admin.posts.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Posts</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/favorite*') ? 'active' : '' }}">
                            <a  href="{{ route('admin.favorites.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Favorite Posts</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                            <a  href="{{ route('admin.post.pending') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Pending Post</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('admin/subscriber/index') ? 'active' : '' }}">
                            <a  href="{{ route('admin.subscriber.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Subscribers</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/comment/all') ? 'active' : '' }}">
                            <a  href="{{ route('admin.comment.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Comments</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('admin/author*') ? 'active' : '' }}">
                            <a  href="{{ route('admin.author.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Authors</span>
                            </a>
                        </li>
                    @endif

                   <!--author menu list-->
                    @if(Request::is('author*'))
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Frontend</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                            <a href="{{ route('author.dashboard') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('author/posts*') ? 'active' : '' }}">
                            <a  href="{{ route('author.posts.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Posts</span>
                            </a>
                        </li>

                        <li class="{{ Request::is('author/favorite*') ? 'active' : '' }}">
                            <a  href="{{ route('author.favorites.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Favorite Posts</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('author/comment/all') ? 'active' : '' }}">
                            <a  href="{{ route('author.comment.index') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Comments</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
