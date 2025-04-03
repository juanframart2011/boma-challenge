<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">

        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="./index.html">
                        <img src="{{ asset( 'chucumites.png' ) }}" class="navbar-logo" alt="{{ config( 'app.name' ) }}">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="./index.html" class="nav-link">{{ config( 'app.name' ) }}</a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>
                </div>
            </div>
        </div>
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ Route::is('home') ? 'active' : '' }}">
                <a href="{{ route( 'home' ) }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span>Home</span>
                    </div>
                </a>
            </li>

            <li class="menu {{ request()->routeIs('campaign.*') ? 'active' : '' }}">
                <a href="#campaign" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('campaign.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <span>Categoría</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ request()->routeIs('campaign.*') ? 'show' : '' }}" id="campaign" data-bs-parent="#accordionExample">
                    <li class="{{ request()->routeIs('campaign.index') ? 'active' : '' }}">
                        <a href="{{ route( 'campaign.list' ) }}">Lista</a>
                    </li>
                    <li class="{{ request()->routeIs('campaign.create') ? 'active' : '' }}">
                        <a href="{{ route( 'campaign.create' ) }}">Agregar</a>
                    </li>                          
                </ul>
            </li>

            <li class="menu {{ request()->routeIs('user.*') ? 'active' : '' }}">
                <a href="#user" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('user.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <span>Usuario</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ request()->routeIs('user.*') ? 'show' : '' }}" id="user" data-bs-parent="#accordionExample">
                    <li class="{{ request()->routeIs('user.index') ? 'active' : '' }}">
                        <a href="{{ route( 'user.list' ) }}">Lista</a>
                    </li>
                    <li class="{{ request()->routeIs('user.create') ? 'active' : '' }}">
                        <a href="{{ route( 'user.create' ) }}">Agregar</a>
                    </li>                          
                </ul>
            </li>
        </ul>                
    </nav>
</div>