<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex align-items-center">
          <a class="navbar-brand brand-logo" href="{{route('home')}}">
            <h3 align="center" style="color: white">iTrack</h3>
          </a>
          <a class="navbar-brand brand-logo-mini" href="{{route('home')}}"><h3>iTrack</h3></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
          <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome!</h5>
          <ul class="navbar-nav navbar-nav-right ml-auto">

            
            <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle ml-2" src="{{asset('assets/images/faces-clipart/pic-1.png')}}" alt="Profile image"> <span class="font-weight-normal"> {{Auth::user()->name}} </span></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                
                
                <a class="dropdown-item" href="{{route('logout.user')}}"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
          </button>
        </div>
      </nav>