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
                    <a href="{{ route('p.index') }}" class="nav-link" id="navTTE"> Dashboard </a>
                </li>
            </ul>
        </div>
    </div>
</nav>