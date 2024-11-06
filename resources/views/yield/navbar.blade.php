<nav class="navbar navbar-expand-lg bg-white navbar-light container-fluid py-3 position-fixed position-fixed fixed-top">
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
                        <a class="nav-link text-uppercase px-3 {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                    </li>
                </ul>
                <div class="d-flex mt-5 mt-lg-0 ps-lg-3 align-items-center justify-content-center">
                    <a href="{{ route('welcome') }}"><button type="button" class="btn btn-primary ms-md-3">Login</button></a>
                </div>
            </div>
        </div>
    </div>
</nav>