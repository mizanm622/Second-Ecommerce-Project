@php
     $wishlist = App\Models\Wishlist::where('user_id',auth()->id())->count();
@endphp
<header class="header">

    <!-- Top Bar -->

    <div class="top_bar">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-row">
                    <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('front-end/assets/images/phone.png')}}" alt=""></div>{{$settings->phone_one}}</div>
                    <div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{asset('front-end/assets/images/mail.png')}}" alt=""></div>{{$settings->main_email}}</div>
                    <div class="top_bar_content ml-auto">
                        <div class="top_bar_menu">
                            <ul class="standard_dropdown top_bar_dropdown">
                                    <li>
                                        <a href="#">Language<span class="fas fa-chevron-down"></span> </a>
                                        <ul>
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">Bangla</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">Currency<span class="fas fa-chevron-down"></span> </a>
                                        <ul>
                                            <li><a href="#">$ US dollar</a></li>
                                            <li><a href="#">৳ BDT Taka </a></li>
                                        </ul>
                                    </li>
                                    @guest
                                    <li>
                                        <a href="#"><span class="fas fa-chevron-down"></span>  Login<span class="fas fa-chevron-down"></span> </a>
                                        <ul style="width:250px; padding:10px">
                                        <div class="user-login">
                                                <form action="{{route('login')}}" method="post">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control form-control-md" name="email" placeholder="Enter your email" required >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password</label>
                                                        <input type="password" class="form-control" name="password" placeholder="Enter your password" required >
                                                    </div>

                                                    <input type="submit"  class="form-control btn btn-info" value="Login">
                                                </form>
                                            </div>
                                        </ul>
                                   </li>
                                   @else
                                   <li>
                                     <a href="#"><span class="fas fa-chevron-down"></span> {{auth()->user()->name}} </a>
                                        <ul style="width:250px; padding:10px">
                                            <li><a  href="{{route('user.profile')}}"><span class="fas fa-user"></span>Profile</a></li>
                                            <li><a  href="{{ route('user.logout') }}"><span class="fas fa-user"></span>Log Out</a></li>
                                        </ul>
                                    </li>
                                    @endguest
                                   <li>
                                      @guest
                                            <a href=""><span class="fas fa-chevron-down"></span> Register</a>
                                            <ul style="width:250px; padding:10px">
                                                <li><a href="{{route('user.register')}}">Create Account</a></li>

                                            </ul>
                                      @endguest

                                    </li>
                                </ul>
                        </div>
                        {{-- <div class="top_bar_user">
                            <div class="user_icon"><img src="images/user.svg" alt=""></div>
                            <div><a href="#">Register</a></div>
                            <div><a href="#">Sign in</a></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Main -->

    <div class="header_main">
        <div class="container">
            <div class="row">

                <!-- Logo -->
                <div class="col-lg-2 col-sm-3 col-3 order-1">
                    <div class="logo_container">
                        <div class="logo"><a href="{{route('home')}}">Ecommerce</a></div>
                    </div>
                </div>

                <!-- Search -->
                <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                    <div class="header_search">
                        <div class="header_search_content">
                            <div class="header_search_form_container">
                                <form action="#" class="header_search_form clearfix">
                                    <input type="search" required="required" class="header_search_input" placeholder="Search for products...">
                                    <div class="custom_dropdown">
                                        <div class="custom_dropdown_list">
                                            <span class="custom_dropdown_placeholder clc">All Categories</span>
                                            <span class="fas fa-chevron-down"></span>
                                            <ul class="custom_list clc">
                                                <li><a class="clc" href="#">All Categories</a></li>
                                                <li><a class="clc" href="#">Computers</a></li>
                                                <li><a class="clc" href="#">Laptops</a></li>
                                                <li><a class="clc" href="#">Cameras</a></li>
                                                <li><a class="clc" href="#">Hardware</a></li>
                                                <li><a class="clc" href="#">Smartphones</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{asset('front-end/assets/images/search.png')}}" alt=""></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Wishlist -->
                <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                    <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                        <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                            <div class="wishlist_icon">
                                <img src="{{asset('front-end/assets/images/heart.png')}}" alt="">
                                <div class="wishlist_count"><span class="">@if(empty($wishlist)) 0 @else {{$wishlist}}  @endif</span></div>
                            </div>
                            <div class="wishlist_content">
                                <div class="wishlist_text"><a href="{{route('wishlist')}}">Wishlist</a></div>

                            </div>
                        </div>

                        <!-- Cart -->
                        <div class="cart">
                            <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                <div class="cart_icon">
                                    <img src="{{asset('front-end/assets/images/cart.png')}}" alt="">
                                    <div class="cart_count"><span>{{Cart::count()}}</span></div>
                                </div>
                                <div class="cart_content">
                                    <div class="cart_text"><a href="{{route('cart')}}">Cart</a></div>
                                    <div class="cart_price">{{$settings->currency}} {{Cart::subtotal()}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->

    <nav class="main_nav">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="main_nav_content d-flex flex-row">

                        <!-- Categories Menu -->

                        <div class="cat_menu_container">
                            <div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
                                <div class="cat_burger"><span></span><span></span><span></span></div>
                                <div class="cat_menu_text">categories</div>
                            </div>

                            <ul class="cat_menu">
                            @foreach($category as $row)

                            @php
                            $subcat=App\Models\Subcategory::where('category_id',$row->id)->get();
                            @endphp
                                <li class="hassubs"><a href="{{route('category.product',$row->id)}}">{{$row->category_name}}<i class="fas fa-chevron-right"></i></a>
                                    <ul>
                                        @foreach ($subcat as $row)
                                        @php
                                        $childcat=App\Models\Childcategory::where('subcategory_id',$row->id)->get();
                                        @endphp
                                        <li class="hassubs">
                                            <a href="{{route('category.product',$row->id)}}">{{$row->subcategory_name}}<i class="fas fa-chevron-right"></i></a>
                                            <ul>
                                                @foreach ( $childcat as $row)
                                                <li><a href="{{route('category.product',$row->id)}}">{{$row->childcategory_name}}<i class="fas fa-chevron-right"></i></a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach

                                    </ul>
                                </li>

                            @endforeach
                            </ul>
                        </div>

                        <!-- Main Nav Menu -->

                        <div class="main_nav_menu ml-auto">
                            <ul class="standard_dropdown main_nav_dropdown">
                                <li><a href="#">Home<span class="fas fa-chevron-down"></span> </a></li>
                                <li class="hassubs">
                                    <a href="#">Super Deals<span class="fas fa-chevron-down"></span> </a>
                                    <ul>
                                        <li>
                                            <a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a>
                                            <ul>
                                                <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                                <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                                <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                    </ul>
                                </li>
                                <li class="hassubs">
                                    <a href="#">Featured Brands<span class="fas fa-chevron-down"></span> </a>
                                    <ul>
                                        <li>
                                            <a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a>
                                            <ul>
                                                <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                                <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                                <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="#">Menu Item<span class="fas fa-chevron-down"></span> </a></li>
                                    </ul>
                                </li>
                                <li class="hassubs">
                                    <a href="#">Pages<span class="fas fa-chevron-down"></span> </a>
                                    <ul>
                                        <li><a href="shop.html">Shop<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="product.html">Product<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="blog.html">Blog<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="blog_single.html">Blog Post<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="regular.html">Regular Post<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="cart.html">Cart<span class="fas fa-chevron-down"></span> </a></li>
                                        <li><a href="contact.html">Contact<span class="fas fa-chevron-down"></span> </a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog<span class="fas fa-chevron-down"></span> </a></li>
                                <li><a href="contact.html">Contact<span class="fas fa-chevron-down"></span> </a></li>
                            </ul>
                        </div>

                        <!-- Menu Trigger -->

                        <div class="menu_trigger_container ml-auto">
                            <div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
                                <div class="menu_burger">
                                    <div class="menu_trigger_text">menu</div>
                                    <div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Menu -->

    <div class="page_menu">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="page_menu_content">

                        <div class="page_menu_search">
                            <form action="#">
                                <input type="search" required="required" class="page_menu_search_input" placeholder="Search for products...">
                            </form>
                        </div>
                        <ul class="page_menu_nav">
                            <li class="page_menu_item has-children">
                                <a href="#">Language<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">English<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Italian<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Spanish<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Japanese<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item has-children">
                                <a href="#">Currency<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">US Dollar<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">EUR Euro<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">GBP British Pound<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">JPY Japanese Yen<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item">
                                <a href="">Home<i class="fa fa-angle-down"></i></a>
                            </li>
                            <li class="page_menu_item has-children">
                                <a href="#">Super Deals<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">Super Deals<i class="fa fa-angle-down"></i></a></li>
                                    <li class="page_menu_item has-children">
                                        <a href="#">Menu Item<i class="fa fa-angle-down"></i></a>
                                        <ul class="page_menu_selection">
                                            <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                            <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                            <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                            <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item has-children">
                                <a href="#">Featured Brands<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">Featured Brands<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item has-children">
                                <a href="#">Trending Styles<i class="fa fa-angle-down"></i></a>
                                <ul class="page_menu_selection">
                                    <li><a href="#">Trending Styles<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                    <li><a href="#">Menu Item<i class="fa fa-angle-down"></i></a></li>
                                </ul>
                            </li>
                            <li class="page_menu_item"><a href="blog.html">blog<i class="fa fa-angle-down"></i></a></li>
                            <li class="page_menu_item"><a href="contact.html">contact<i class="fa fa-angle-down"></i></a></li>
                        </ul>

                        <div class="menu_contact">
                            <div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('front-end/assets/images/phone_white.png')}}" alt=""></div>+38 068 005 3570</div>
                            <div class="menu_contact_item"><div class="menu_contact_icon"><img src="{{asset('front-end/assets/images/mail_white.png')}}" alt=""></div><a href="https://colorlib.com/cdn-cgi/l/email-protection#fd9b9c8e898e9c91988ebd9a909c9491d39e9290"><span class="__cf_email__" data-cfemail="5f393e2c2b2c3e333a2c1f38323e3633713c3032">[email&#160;protected]</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<script>
//     window.onbeforeunload = () => {
//   return "Do you really want to close?";
// }
</script>


