<li class="nav-item">
    <!-- Change color depends on user's role -->
    <a class="nav-link" data-widget="pushmenu" href="#"
        @if(config('adminlte.sidebar_collapse_remember'))
            data-enable-remember="true"
        @endif
        @if(!config('adminlte.sidebar_collapse_remember_no_transition'))
            data-no-transition-after-reload="false"
        @endif
        @if(config('adminlte.sidebar_collapse_auto_size'))
            data-auto-collapse-size="{{ config('adminlte.sidebar_collapse_auto_size') }}"
        @endif
        
        @if(auth()->user()->role->role == 'Student')
            style="color: white;"
        @elseif(auth()->user()->role->role == 'Faculty')
            style="color: white;"
        @elseif(auth()->user()->role->role == 'Staff')
            style="color: white;"
        @elseif(auth()->user()->role->role == 'Nurse')
            style="color: black;"
        @elseif(auth()->user()->role->role == 'Doctor')
            style="color: white;"
        @elseif(auth()->user()->role->role == 'Dentist')
            style="color: white;"
        @elseif(auth()->user()->role->role == 'Admin')
            style="color: white;"
        @else
            style="color: white;"
        @endif
        >
        <i class="fas fa-bars"></i>
        <span class="sr-only">{{ __('adminlte::adminlte.toggle_navigation') }}</span>
    </a>
</li>