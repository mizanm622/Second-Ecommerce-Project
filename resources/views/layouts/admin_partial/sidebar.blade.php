
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('admin.home')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{asset($settings->logo)}}" alt="{{$settings->logo}}" class="img-thumbnail rounded-circle m-auto" width="40" height="40">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 text-capitalize text-primary m-1">{{$settings->name}}</span>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item active">
            <a href="{{route('admin.home')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
    </li>
    <!-- Layouts -->
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Pages</span>
    </li>
    <!--Category area-->
    <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Category</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item">
                    <a href="{{route('category.index')}}" class="menu-link">
                    <div data-i18n="Account">Category</div>
                </a>
            </li>
        <li class="menu-item">
                <a href="{{route('subcategory.index')}}" class="menu-link">
                    <div data-i18n="Notifications">Subcategory</div>
                </a>
        </li>
        <li class="menu-item">
                <a href="{{route('childcategory.index')}}" class="menu-link">
                    <div data-i18n="Connections">Child Category</div>
                </a>
        </li>
        <li class="menu-item">
                <a href="{{route('brand.index')}}" class="menu-link">
                    <div data-i18n="Connections">Brand</div>
                </a>
        </li>
        <li class="menu-item">
                <a href="{{route('warehouse.index')}}" class="menu-link">
                    <div data-i18n="Connections">Warehouse</div>
                </a>
        </li>

        </ul>
    </li>
    <!--Product area-->
    <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Product</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{route('product.index')}}" class="menu-link">
                    <div data-i18n="Account">Add New Product</div>
                </a>
            </li>

        <li class="menu-item">
                <a href="{{route('product.show')}}" class="menu-link">
                    <div data-i18n="Connections">Manage Product</div>
                </a>
        </li>
        <li class="menu-item">
                <a href="" class="menu-link">
                    <div data-i18n="Connections">Product --</div>
                </a>
        </li>

        </ul>
    </li>
    <!--Offer area-->
    <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Offers</div>
            </a>
        <ul class="menu-sub">
        <li class="menu-item">
                <a href="{{route('coupon.index')}}" class="menu-link">
                    <div data-i18n="Account">Coupon</div>
                </a>
        </li>
        <li class="menu-item">
                <a href="{{route('campaing.index')}}" class="menu-link">
                    <div data-i18n="Connections">E-Campaing</div>
                </a>
        </li>
        <li class="menu-item">
                <a href="{{route('pickup.index')}}" class="menu-link">
                    <div data-i18n="Connections">Pickup Point</div>
                </a>
        </li>

        </ul>
    </li>
    <!--Orders area-->
    <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Orders</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{route('order.pending')}}" class="menu-link">
                    <div data-i18n="Account">Pending Orders</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('order.tracking')}}" class="menu-link">
                    <div data-i18n="Connections">Tracking Orders</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('order.complete')}}" class="menu-link">
                    <div data-i18n="Connections">Complete Orders</div>
                </a>
            </li>
        </ul>
    </li>
            <!--Setting area-->
    <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Settings</div>
            </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{route('seo.setting')}}" class="menu-link">
                    <div data-i18n="Account">SEO Setting</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('website.setting')}}" class="menu-link">
                    <div data-i18n="Notifications">Website Setting</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('page.index')}}" class="menu-link">
                    <div data-i18n="Connections">Page Setting</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('smtp.setting')}}" class="menu-link">
                    <div data-i18n="Connections">SMTP Settings</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="{{route('payment.gateway')}}" class="menu-link">
                    <div data-i18n="Connections">Payment Getwat Settings</div>
                </a>
            </li>

        </ul>
    </li>



    <!-- Tables -->
    <li class="menu-item">
            <a href="tables-basic.html" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">Tables</div>
            </a>
    </li>
    <!-- Misc -->


    </ul>
  </aside>
