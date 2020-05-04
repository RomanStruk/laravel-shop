
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="/storage/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{Auth::user()->detail->avatar}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->fullName}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard.index')}}"
                       class="nav-link @if(Route::currentRouteName() == 'admin.dashboard.index') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.order.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.order.index') active @endif">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Замовлення
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.category.index') active @endif">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Категорії
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.product.index') active @endif">
                        <i class="nav-icon fas fa-lira-sign"></i>
                        <p>
                            Товари
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.user.index') active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Користувачі
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.media.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.media.index') active @endif">
                        <i class="nav-icon fas fa-images"></i>
                        <p>
                            Медіа
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.filter.index') }}" class="nav-link @if(Route::currentRouteName() == 'admin.filter.index') active @endif">
                        <i class="nav-icon fas fa-filter"></i>
                        <p>
                            Фільтри
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
