<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#"
                    data-toggle="sidebar"
                    class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <!-- <li><a href="#"
                    data-toggle="search"
                    class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
        </ul>
        
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#"
                data-toggle="dropdown"
                class=""></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="float-right">
                       
                    </div>
                </div>
                <div class="">
                    
        <li class="dropdown"><a href="#"
                data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
               @if(auth()->user()->rul == 'ADMIN')
                <img alt="image"
                
                    src="{{ asset('img/avatar/school.jpg') }}"
                    class="rounded-circle mr-1">
                    @endif
                    @if(auth()->user()->rul == 'PESERTA')
                <img alt="image"
                    src="{{ asset('img/avatar/avatar-1.png') }}"
                    class="rounded-circle mr-1">
                    @endif
                <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Anda telah login </div>
                <a href="{{ route('pages.Profile.UserProfile') }}"
                    class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile 
   
                </a>
                <div class="dropdown-divider"></div>
                <a href="#"
                    class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id='logout-form' action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
