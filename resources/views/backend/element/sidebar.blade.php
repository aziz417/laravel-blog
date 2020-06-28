<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="{{ asset('backend/img/profile_small.jpg')}}" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ Auth::user()->name }}</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
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
                        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <a href="{{ route('backend.admin.dashboard') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a  href="">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Category</span>
                            </a>
                        </li>
                    @endif

                   <!--author menu list-->
                    @if(Request::is('author*'))
                        <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                            <a href="{{ route('backend.author.dashboard') }}">
                                <i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span>
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </nav>