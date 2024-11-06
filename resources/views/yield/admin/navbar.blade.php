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
                    <li class="nav-item dropdown">
                        <a class="nav-link active text-uppercase  dropdown-toggle text-center" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Manage</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('admin.home') }}" class="dropdown-item text-uppercase ">Contents</a></li>
                            <li><a href="{{ route('admin.user') }}" class="dropdown-item text-uppercase ">Users</a></li>
                        </ul>
                    </li>
                </ul>   
                <div class="d-flex mt-5 mt-lg-0 ps-lg-3 align-items-center justify-content-center">
                    <a href="{{ route('admin.logout') }}" class="btn btn-primary ms-md-3">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>
