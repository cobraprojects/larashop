<!-- ##### SIDEBAR LOGO ##### -->
<div class="kt-sideleft-header">
    <div class="kt-logo"><a href="/" target="_blank">{{ config('app.name') }}</a></div>
    <div id="ktDate" class="kt-date-today"></div>
    <div class="input-group kt-input-search">
        <input type="text" class="form-control" placeholder="بحث ...">
        <span class="input-group-btn mg-0">
            <button class="btn"><i class="fa fa-search"></i></button>
        </span>
    </div><!-- input-group -->
</div><!-- kt-sideleft-header -->

<!-- ##### SIDEBAR MENU ##### -->
@php($routeName = Str::of(Route::currentRouteName())->explode('.'))
<div class="kt-sideleft">
    <label class="kt-sidebar-label">القائمة</label>
    <ul class="nav kt-sideleft-menu">
        {{--لوحة التحكم--}}
        <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link {{ $routeName->contains('dashboard') ? 'active' : '' }}">
                <i class="fa fa-home"></i>
                <span>لوحة التحكم</span>
            </a>
        </li><!-- nav-item -->

        {{--ادارة المستخدمين--}}
        @admin('super')
        <li class="nav-item">
            <a href="" class="nav-link with-sub {{ $routeName->contains('roles')||$routeName->contains('role')||request()->routeIs('admin.show') ? 'active' : '' }}">
                <i class="fa fa-users"></i>
                <span>إدارةالمستخدمين</span>
            </a>
            <ul class="nav-sub">
                <li class="nav-item"><a href="{{ route('admin.roles') }}"
                        class="nav-link {{ $routeName->contains('roles')||$routeName->contains('roles') ? 'active' : '' }}">الوظائف والصلاحيات</a></li>
                <li class="nav-item"><a href="{{ route('admin.show') }}" class="nav-link {{ request()->routeIs('admin.show') ? 'active' : '' }} ">المستخدمين</a></li>
            </ul>
        </li><!-- nav-item -->
        @endadmin

        <li class="nav-item">
            <a href="" class="nav-link with-sub {{ $routeName->contains(LaraShop::getShopRouteName ()) ? 'active' : '' }}">
                <i class="fa fa-shopping-bag"></i>
                <span>المتجر</span>
            </a>
            <ul class="nav-sub">
                @permitTo('ReadLarashopCategory')
                <li class="nav-item">
                    <a href="{{ route(LaraShop::adminName().'.category.index') }}" class="nav-link {{ $routeName->contains('category') ? 'active' : '' }}">
                        <i class="fa fa-bars"></i>
                        <span>الأقسام</span>
                    </a>
                </li>
                @endpermitTo
                @permitTo('ReadLarashopBrand')
                <li class="nav-item">
                    <a href="{{ route(LaraShop::adminName().'.brand.index') }}" class="nav-link {{ $routeName->contains('brand') ? 'active' : '' }}">
                        <i class="fa fa-star"></i>
                        <span>البراندات</span>
                    </a>
                </li>
                @endpermitTo
                @permitTo('ReadLarashopProduct')
                <li class="nav-item">
                    <a href="{{ route(LaraShop::adminName().'.product.index') }}" class="nav-link {{ $routeName->contains('product') ? 'active' : '' }}">
                        <i class="fa fa-th"></i>
                        <span>المنتجات</span>
                    </a>
                </li>
                @endpermitTo
                @permitTo('ReadLarashopCoupon')
                <li class="nav-item">
                    <a href="{{ route(LaraShop::adminName().'.coupon.index') }}" class="nav-link {{ $routeName->contains('coupon') ? 'active' : '' }}">
                        <i class="fa fa-gift"></i>
                        <span>كوبونات الخصم</span>
                    </a>
                </li>
                @endpermitTo
                @permitTo('ReadLarashopCity')
                <li class="nav-item">
                    <a href="{{ route(LaraShop::adminName().'.city.index') }}" class="nav-link {{ $routeName->contains('city') ? 'active' : '' }}">
                        <i class="fa fa-truck"></i>
                        <span>المدن وتكلفة الشحن</span>
                    </a>
                </li>
                @endpermitTo
                @permitTo('ReadLarashopOrder')
                <li class="nav-item">
                    <a href="{{ route(LaraShop::adminName().'.order.index') }}" class="nav-link {{ $routeName->contains('order') ? 'active' : '' }}">
                        <i class="fa fa-cart-arrow-down"></i>
                        <span>طلبات الشراء</span>
                    </a>
                </li>
                @endpermitTo
                @permitTo('ReadLarashopSetting')
                <li class="nav-item">
                    <a href="{{ route(LaraShop::adminName().'.setting.index') }}" class="nav-link {{ $routeName->contains('setting') ? 'active' : '' }}">
                        <i class="fa fa-gear"></i>
                        <span>اعدادات المتجر</span>
                    </a>
                </li>
                @endpermitTo
            </ul>
        </li><!-- nav-item -->
    </ul>
</div><!-- kt-sideleft -->