@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )      <!-- No Role -->
@php( $dashboard_url1 = View::getSection('dashboard_url1') ?? config('adminlte.dashboard_url1', 'home') )   <!-- Student -->
@php( $dashboard_url2 = View::getSection('dashboard_url2') ?? config('adminlte.dashboard_url2', 'home') )   <!-- Faculty -->
@php( $dashboard_url3 = View::getSection('dashboard_url3') ?? config('adminlte.dashboard_url3', 'home') )   <!-- Staff -->
@php( $dashboard_url4 = View::getSection('dashboard_url4') ?? config('adminlte.dashboard_url4', 'home') )   <!-- Nurse -->
@php( $dashboard_url5 = View::getSection('dashboard_url5') ?? config('adminlte.dashboard_url5', 'home') )   <!-- Doctor -->
@php( $dashboard_url6 = View::getSection('dashboard_url6') ?? config('adminlte.dashboard_url6', 'home') )   <!-- Dentist -->
@php( $dashboard_url7 = View::getSection('dashboard_url7') ?? config('adminlte.dashboard_url7', 'home') )   <!-- Admin -->

@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif
@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url1 = $dashboard_url1 ? route($dashboard_url1) : '' )
@else
    @php( $dashboard_url1 = $dashboard_url1 ? url($dashboard_url1) : '' )
@endif
@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url2 = $dashboard_url2 ? route($dashboard_url2) : '' )
@else
    @php( $dashboard_url2 = $dashboard_url2 ? url($dashboard_url2) : '' )
@endif
@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url3 = $dashboard_url3 ? route($dashboard_url3) : '' )
@else
    @php( $dashboard_url3 = $dashboard_url3 ? url($dashboard_url3) : '' )
@endif
@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url4 = $dashboard_url4 ? route($dashboard_url4) : '' )
@else
    @php( $dashboard_url4 = $dashboard_url4 ? url($dashboard_url4) : '' )
@endif
@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url5 = $dashboard_url5 ? route($dashboard_url5) : '' )
@else
    @php( $dashboard_url5 = $dashboard_url5 ? url($dashboard_url5) : '' )
@endif
@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url6 = $dashboard_url6 ? route($dashboard_url6) : '' )
@else
    @php( $dashboard_url6 = $dashboard_url6 ? url($dashboard_url6) : '' )
@endif
@if (config('adminlte.use_route_url', false))
    @php( $dashboard_url7 = $dashboard_url7 ? route($dashboard_url7) : '' )
@else
    @php( $dashboard_url7 = $dashboard_url7 ? url($dashboard_url7) : '' )
@endif

@if(auth()->user()->role->role == 'Student')
    <a href="{{ $dashboard_url1 }}"
        @if($layoutHelper->isLayoutTopnavEnabled())
            class="navbar-brand {{ config('adminlte.classes_brand') }}"
        @else
            class="brand-link {{ config('adminlte.classes_brand') }}"
        @endif>

        {{-- Small brand logo --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
            alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
            class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
            style="opacity:.8">

        {{-- Brand text --}}
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo1', '<b>Admin</b>LTE') !!}
        </span>

    </a>
@elseif(auth()->user()->role->role == 'Faculty')
    <a href="{{ $dashboard_url2 }}"
        @if($layoutHelper->isLayoutTopnavEnabled())
            class="navbar-brand {{ config('adminlte.classes_brand') }}"
        @else
            class="brand-link {{ config('adminlte.classes_brand') }}"
        @endif>

        {{-- Small brand logo --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
            alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
            class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
            style="opacity:.8">

        {{-- Brand text --}}
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo2', '<b>Admin</b>LTE') !!}
        </span>

    </a>
@elseif(auth()->user()->role->role == 'Staff')
    <a href="{{ $dashboard_url3 }}"
        @if($layoutHelper->isLayoutTopnavEnabled())
            class="navbar-brand {{ config('adminlte.classes_brand') }}"
        @else
            class="brand-link {{ config('adminlte.classes_brand') }}"
        @endif>

        {{-- Small brand logo --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
            alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
            class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
            style="opacity:.8">

        {{-- Brand text --}}
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo3', '<b>Admin</b>LTE') !!}
        </span>

    </a>
@elseif(auth()->user()->role->role == 'Nurse')
    <a href="{{ $dashboard_url4 }}"
        @if($layoutHelper->isLayoutTopnavEnabled())
            class="navbar-brand {{ config('adminlte.classes_brand') }}"
        @else
            class="brand-link {{ config('adminlte.classes_brand') }}"
        @endif>

        {{-- Small brand logo --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
            alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
            class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
            style="opacity:.8">

        {{-- Brand text --}}
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo4', '<b>Admin</b>LTE') !!}
        </span>

    </a>
@elseif(auth()->user()->role->role == 'Doctor')
    <a href="{{ $dashboard_url5 }}"
        @if($layoutHelper->isLayoutTopnavEnabled())
            class="navbar-brand {{ config('adminlte.classes_brand') }}"
        @else
            class="brand-link {{ config('adminlte.classes_brand') }}"
        @endif>

        {{-- Small brand logo --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
            alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
            class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
            style="opacity:.8">

        {{-- Brand text --}}
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo5', '<b>Admin</b>LTE') !!}
        </span>

    </a>
@elseif(auth()->user()->role->role == 'Dentist')
    <a href="{{ $dashboard_url6 }}"
        @if($layoutHelper->isLayoutTopnavEnabled())
            class="navbar-brand {{ config('adminlte.classes_brand') }}"
        @else
            class="brand-link {{ config('adminlte.classes_brand') }}"
        @endif>

        {{-- Small brand logo --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
            alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
            class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
            style="opacity:.8">

        {{-- Brand text --}}
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo6', '<b>Admin</b>LTE') !!}
        </span>

    </a>
@elseif(auth()->user()->role->role == 'Admin')
    <a href="{{ $dashboard_url7 }}"
        @if($layoutHelper->isLayoutTopnavEnabled())
            class="navbar-brand {{ config('adminlte.classes_brand') }}"
        @else
            class="brand-link {{ config('adminlte.classes_brand') }}"
        @endif>

        {{-- Small brand logo --}}
        <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
            alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
            class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
            style="opacity:.8">

        {{-- Brand text --}}
        <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
            {!! config('adminlte.logo6', '<b>Admin</b>LTE') !!}
        </span>

    </a>
@else
<a href="{{ $dashboard_url }}"
    @if($layoutHelper->isLayoutTopnavEnabled())
        class="navbar-brand {{ config('adminlte.classes_brand') }}"
    @else
        class="brand-link {{ config('adminlte.classes_brand') }}"
    @endif>

    {{-- Small brand logo --}}
    <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
         alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
         class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
         style="opacity:.8">

    {{-- Brand text --}}
    <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
        {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
    </span>

</a>
@endif