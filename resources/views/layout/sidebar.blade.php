<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">Andini Yeri</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{__('messages.Pages')}}</li>
            <li class="dropdown active">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-film"></i><span>{{__('messages.Movies')}}</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="active">
                        <a class="nav-link" href="{{ url('dashboard') }}">{{__('messages.Search Movies')}}</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ url('favorite') }}">{{__('messages.My Favorites')}}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>