<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">
                                    @if (Auth::guest())
                                        Usuario invitado
                                    @else
                                    {{ Auth::user()->name }}
                                    @endif
                                </strong>
                            </span> <span class="text-muted text-xs block"><b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        @endif

                    </ul>
                </div>
                <div class="logo-element">
                    LSIU
                </div>
            </li>
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
                <li class="{{ isActiveRoute('main') }}">
                    <a href="{{ url('/') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Inicio</span></a>
                </li>
                <li class="{{ isActiveRoute('forum') }}">
                    <a href="{{ url('/forum') }}" target="_blank"><i class="fa fa-coffee"></i> <span class="nav-label">Foro</span> </a>
                </li>
                <li class="{{ isActiveRoute('encuesta') }}">
                    <a href="{{ url('/encuesta') }}"><i class="fa fa-calendar"></i> <span class="nav-label">Encuestas</span> </a>
                </li>
                <li class="{{ isActiveRoute('temas') }}">
                    <a href="{{ url('/temas') }}"><i class="fa fa-book"></i> <span class="nav-label">Temáticas</span> </a>
                </li>
                <li class="{{ isActiveRoute('tareas') }}">
                    <a href="{{ url('/tareas') }}"><i class="fa fa-list"></i> <span class="nav-label">Tareas (individual)</span> </a>
                </li>
                <li class="{{ isActiveRoute('apuntes') }}">
                    <a href="{{ url('/apuntes') }}"><i class="fa fa-pencil"></i> <span class="nav-label">Apuntes (individual)</span> </a>
                </li>
                <li class="{{ isActiveRoute('messages') }}">
                    <a href="{{ url('/messages') }}"><i class="fa fa-comments"></i> <span class="nav-label">Chat</span> </a>
                </li>
                <li class="{{ isActiveRoute('bookmarks') }}">
                    <a href="{{ url('/bookmarks') }}"><i class="fa fa-bookmark"></i> <span class="nav-label">Bookmarks</span> </a>
                </li>
                <li class="{{ isActiveRoute('glosario') }}">
                    <a href="{{ url('/glosario') }}"><i class="fa fa-book"></i> <span class="nav-label">Glosary</span> </a>
                </li>
            @endif
        </ul>

    </div>
</nav>
