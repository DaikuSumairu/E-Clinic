<!-- Change navigation head depends on user's role -->
@if(auth()->check())
    <nav class="main-header navbar
        {{ config('adminlte.classes_topnav_nav', 'navbar-expand') }}
        {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}"
        @if(auth()->user()->role->role == 'Student')
            style="background-color: #c5c01a;"
        @elseif(auth()->user()->role->role == 'Faculty')
            style="background-color: #1e33c3;"
        @elseif(auth()->user()->role->role == 'Staff')
            style="background-color: #7a89f5;"
        @elseif(auth()->user()->role->role == 'Nurse')
            style="background-color: #ffffff;"
        @elseif(auth()->user()->role->role == 'Doctor')
            style="background-color: #ff4d4d;"
        @elseif(auth()->user()->role->role == 'Dentist')
            style="background-color: #3eb336;"
        @elseif(auth()->user()->role->role == 'Admin')
            style="background-color: #b5b2b2;"
        @else
            style="background-color: #2f2b2b;"
        @endif
        >
@endif

    {{-- Navbar left links --}}
    <ul class="navbar-nav">
        {{-- Left sidebar toggler link --}}
        @include('adminlte::partials.navbar.menu-item-left-sidebar-toggler')

        {{-- Configured left links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')

        {{-- Custom left links --}}
        @yield('content_top_nav_left')
    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">
        {{-- Custom right links --}}
        @yield('content_top_nav_right')

        {{-- Configured right links --}}
        @each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-right'), 'item')

        {{-- User menu link --}}
        @if(Auth::user())
            @if(config('adminlte.usermenu_enabled'))
                @include('adminlte::partials.navbar.menu-item-dropdown-user-menu')
            @else
                @include('adminlte::partials.navbar.menu-item-logout-link')
            @endif
        @endif

        {{-- Right sidebar toggler link --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.navbar.menu-item-right-sidebar-toggler')
        @endif
    </ul>

</nav>
