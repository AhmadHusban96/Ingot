<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 side-bar-brand" href="/"
           target="_blank">
            <img src="{{asset('img/logo_inverted.png')}}" class="navbar-brand-img h-100 side-bar-logo" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{basename(strtok($_SERVER["REQUEST_URI"],'?')) == 'dashboard'?'active bg-gradient-danger':''}}"
                   href="{{route('admin.home')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{basename(strtok($_SERVER["REQUEST_URI"],'?')) == 'users'?'active bg-gradient-danger':''}}"
                   href="{{route('admin.users')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{basename(strtok($_SERVER["REQUEST_URI"],'?')) == 'payment-methods'?'active bg-gradient-danger':''}}"
                   href="{{route('admin.payment_methods')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">payment</i>
                    </div>
                    <span class="nav-link-text ms-1">Payment Methods</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{basename(strtok($_SERVER["REQUEST_URI"],'?')) == 'currencies'?'active bg-gradient-danger':''}}"
                   href="{{route('admin.currencies')}}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">attach_money</i>
                    </div>
                    <span class="nav-link-text ms-1">Currencies</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
