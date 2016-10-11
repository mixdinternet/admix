<header class="main-header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-lg">{!! config('admin.name') !!}</span>
        <span class="logo-mini">{!! config('admin.name_mini') !!}</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ (auth()->user()->image->url('crop')) ? : '/assets/img/avatar.png' }}"
                             class="user-image" alt="{{ auth()->user()->name }}"/>
                        <span class="hidden-xs">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ (auth()->user()->image->url('crop')) ? : '/assets/img/avatar.png' }}"
                                 class="img-circle" alt="{{ auth()->user()->name }}"/>
                            <p>
                                {{ auth()->user()->name }}
                                <small>{{ auth()->user()->email }}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ route('admin.profile') }}" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">Sair</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>