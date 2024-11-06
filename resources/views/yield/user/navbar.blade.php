<nav class="navbar navbar-expand-lg bg-white navbar-light container-fluid py-3 position-fixed fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <h3>WEB MEDIA.</h3>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav align-items-center justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase px-3 {{ request()->is('home') ? 'active' : '' }}" href="/home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ request()->is('profile*') || request()->is('like*') ? 'active' : '' }} text-uppercase dropdown-toggle text-center" data-bs-toggle="dropdown" href="{{ route('profile.index') }}" role="button" aria-expanded="false">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('profile.index') }}" class="dropdown-item text-uppercase ">Profil</a></li>
                            <li><a href="{{ route('like.index') }}" class="dropdown-item text-uppercase ">Like <span class="badge bg-secondary">New</span></a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-flex mt-5 mt-lg-0 ps-lg-3 align-items-center justify-content-center">
                    <a href="{{ route('logout') }}"><button type="button" class="btn btn-primary ms-md-3">Logout</button></a>
                </div>
            </div>
        </div>
    </div>
</nav>
