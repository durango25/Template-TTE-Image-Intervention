<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="{{ route('p.index') }}" class="navbar-brand">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Aplikasi" class="brand-image">
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link" id="navDashboard"> Dashboard </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link" id="navUser"> Data User </a>
                </li> -->
                <li class="nav-item">
                    <a href="{{ route('tte.index') }}" class="nav-link" id="navTTE"> Data TTE </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" title="Logout" onclick="event.preventDefault(); $('#form-logout').submit();">
                        <i class="fa fa-power-off"></i> Logout
                        <form method="POST" action="{{ route('logout') }}" id="form-logout">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>