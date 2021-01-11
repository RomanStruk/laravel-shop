
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
                <a href="{{route('admin.user.show', Auth::user())}}" class="d-block">{{Auth::user()->fullName}}</a>
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

                <li class="nav-item has-treeview @if(request()->routeIs('admin.order*')) menu-open @endif">
                    <a href="{{ route('admin.order.index') }}" class="nav-link  @if(request()->routeIs('admin.order*')) active @endif">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Замовлення
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.order.index') }}" class="nav-link @if(request()->routeIs('admin.order.index')) active @endif">
                                <i class="nav-icon fas fa-lira-sign"></i>
                                <p>Замовлення</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.order.create') }}" class="nav-link @if(request()->routeIs('admin.order.create')) active @endif">
                                <i class="icon fas fa-plus nav-icon"></i>
                                <p>Додати замовлення</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(request()->routeIs('admin.category*')) menu-open @endif">
                    <a href="{{ route('admin.category.index') }}" class="nav-link @if(request()->routeIs('admin.category*')) active @endif">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Категорії
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link @if(request()->routeIs('admin.category.index')) active @endif">
                                <i class="nav-icon fas fa-lira-sign"></i>
                                <p>Категорії</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category.create') }}" class="nav-link @if(request()->routeIs('admin.category.create')) active @endif">
                                <i class="icon fas fa-plus nav-icon"></i>
                                <p>Додати категорію</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
@if(request()->routeIs('admin.product*') or request()->routeIs('admin.supplier*') or request()->routeIs('admin.syllable*')) menu-open @endif
                    ">
                    <a href="{{ route('admin.product.index') }}" class="nav-link @if(request()->routeIs('admin.product*') or request()->routeIs('admin.supplier*') or request()->routeIs('admin.syllable*')) active @endif">
                        <i class="nav-icon fas fa-lira-sign"></i>
                        <p>
                            Товари
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link @if(request()->routeIs('admin.product.index')) active @endif">
                                <i class="nav-icon fas fa-lira-sign"></i>
                                <p>Товари</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.create') }}" class="nav-link @if(request()->routeIs('admin.product.create')) active @endif">
                                <i class="icon fas fa-plus nav-icon"></i>
                                <p>Додати товар</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.supplier.index') }}" class="nav-link @if(request()->routeIs('admin.supplier*')) active @endif">
                                <i class="icon fas fa-truck nav-icon"></i>
                                <p>Постачальники</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.syllable.index') }}" class="nav-link @if(request()->routeIs('admin.syllable*')) active @endif">
                                <i class="icon fas fa-shopping-bag nav-icon"></i>
                                <p>Склад</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(request()->routeIs('admin.user*')) menu-open @endif">
                    <a href="{{ route('admin.user.index') }}" class="nav-link @if(request()->routeIs('admin.user.*')) active @endif">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Користувачі
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.user.index') }}" class="nav-link @if(request()->routeIs('admin.user.index')) active @endif">
                                <i class="nav-icon fas fa-lira-sign"></i>
                                <p>Користувачі</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user.create') }}" class="nav-link @if(request()->routeIs('admin.user.create')) active @endif">
                                <i class="icon fas fa-plus nav-icon"></i>
                                <p>Додати користувача</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(request()->routeIs('admin.media*')) menu-open @endif">
                    <a href="{{ route('admin.media.index') }}" class="nav-link @if(request()->routeIs('admin.media.*')) active @endif">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Медіа<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.media.index') }}" class="nav-link @if(request()->routeIs('admin.media.index')) active @endif">
                                <i class="nav-icon fas fa-lira-sign"></i>
                                <p>Медіа</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.media.create') }}" class="nav-link @if(request()->routeIs('admin.media.create')) active @endif">
                                <i class="icon fas fa-plus nav-icon"></i>
                                <p>Додати медіа</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview @if(request()->routeIs('admin.filter*')) menu-open @endif">
                    <a href="{{ route('admin.filter.index') }}" class="nav-link @if(request()->routeIs('admin.filter.*')) active @endif">
                        <i class="nav-icon fas fa-filter"></i>
                        <p>
                            Фільтри
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.filter.index') }}" class="nav-link @if(request()->routeIs('admin.filter.index')) active @endif">
                                <i class="nav-icon fas fa-lira-sign"></i>
                                <p>Фільтри</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.filter.create') }}" class="nav-link @if(request()->routeIs('admin.filter.create')) active @endif">
                                <i class="icon fas fa-plus nav-icon"></i>
                                <p>Додати фільтр</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
