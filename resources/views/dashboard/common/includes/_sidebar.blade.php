    <!-- BEGIN: Main Menu-->
    <div class="main-menu material-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="user-profile">
            <div class="user-info text-center pt-1 pb-1">
                <img class="user-img img-fluid rounded-circle" src="{{ asset('assets/admin/images/portrait/small/avatar-s-1.png') }}" />
                <div class="name-wrapper d-block dropdown">
                    <a class="white dropdown-toggle ml-2" id="user-account" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-name">Charlie Adams</span></a>
                    <div class="text-light">UX Designer</div>
                    <div class="dropdown-menu arrow" aria-labelledby="dropdownMenuLink"><a class="dropdown-item"><i class="material-icons align-middle mr-1">person</i><span class="align-middle">Profile</span></a><a class="dropdown-item"><i class="material-icons align-middle mr-1">message</i><span class="align-middle">Messages</span></a><a class="dropdown-item"><i class="material-icons align-middle mr-1">attach_money</i><span class="align-middle">Balance</span></a><a class="dropdown-item"><i class="material-icons align-middle mr-1">settings</i><span class="align-middle">Settings</span></a><a class="dropdown-item"><i class="material-icons align-middle mr-1">power_settings_new</i><span class="align-middle">Log Out</span></a></div>
                </div>
            </div>
        </div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <!-- Start Dashboard Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <!--<i class="material-icons">drag_indicator</i>-->
                        <span class="menu-title" data-i18n="Dashboard">{{ trans('Admin/setting.dashboard') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Admins & Moderators -->
                        <li>
                            <a class="menu-item" href="#">
                                <i class="material-icons">face</i>
                                <span data-i18n="Vertical">{{trans('Admin\admins.admins')}}</span>
                            </a>
                            <ul class="menu-content">
                                <li>
                                    <a class="menu-item" href="{{ route('Admins.index') }}">
                                        <i class="material-icons">face</i>
                                        <span data-i18n="{{trans('Admin\admins.admin')}}">{{trans('Admin\admins.admin')}}</span></a>
                                </li>
                                <li>
                                    <a class="menu-item" href="{{ route('farmers.index') }}">
                                        <i class="icon-user-follow"></i>
                                        <span data-i18n="{{trans('Admin\admins.admin')}}">Farmers</span></a>
                                </li>
                                <li>
                                    <a class="menu-item" href="{{ route('users.index') }}">
                                        <i class="material-icons">face</i>
                                        <span data-i18n="{{trans('Admin\admins.users')}}">Users</span></a>
                                </li>
                            </ul>
                        </li>
                        <!-- End Admins & Moderators -->
                        <!-- Start Setting -->
                        <li>
                            <a class="menu-item" href="{{route('settings')}}">
                                <i class="material-icons">tune</i>
                                <span data-i18n="eCommerce">{{ trans('Admin/setting.page_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Setting -->
                    </ul>
                </li>
                <!-- End Dashboard Dropdown Menu -->
                <!-- Start Department Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">account_balance</i>
                        <span class="menu-title" data-i18n="Departments">{{ trans('Admin/departments.departments_title_in_sidebar') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Department -->
                        <li>
                            <a class="menu-item" href="{{route('Departments.index')}}">
                                <i class="material-icons">account_balance</i>
                                <span data-i18n="Departments">{{ trans('Admin/departments.departments_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Department -->
                    </ul>
                </li>
                <!-- End Department Dropdown Menu -->
                {{-- <li class=" nav-item"><a href="#"><i class="material-icons">tv</i><span class="menu-title" data-i18n="Templates">Templates</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Vertical">Vertical</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="../material-vertical-menu-template"><i class="material-icons"></i><span data-i18n="Classic Menu">Classic Menu</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-compact-menu-template"><i class="material-icons"></i><span data-i18n="Compact Menu">Compact Menu</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-collapsed-menu-template"><i class="material-icons"></i><span data-i18n="Collapsed Menu">Collapsed Menu</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-modern-menu-template"><i class="material-icons"></i><span>Modern Menu</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-content-menu-template"><i class="material-icons"></i><span data-i18n="Content Menu">Content Menu</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-overlay-menu-template"><i class="material-icons"></i><span data-i18n="Overlay Menu">Overlay Menu</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Horizontal">Horizontal</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="../material-horizontal-menu-template"><i class="material-icons"></i><span data-i18n="Classic">Classic</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-horizontal-menu-template-nav"><i class="material-icons"></i><span data-i18n="Full Width">Full Width</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Admin Panels">Admin Panels</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Admin Panels">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="../material-ecommerce-menu-template" target="_blank"><i class="material-icons">add_shopping_cart</i><span class="menu-title" data-i18n="eCommerce">eCommerce</span></a>
                </li>
                <li class=" nav-item"><a href="../material-travel-menu-template" target="_blank"><i class="material-icons">call_merge</i><span class="menu-title" data-i18n="Travel &amp; Booking">Travel &amp; Booking</span></a>
                </li>
                <li class=" nav-item"><a href="../material-hospital-menu-template" target="_blank"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Hospital">Hospital</span></a>
                </li>
                <li class=" nav-item"><a href="../material-crypto-menu-template" target="_blank"><i class="material-icons">attach_money</i><span class="menu-title" data-i18n="Crypto">Crypto</span></a>
                </li>
                <li class=" nav-item"><a href="../material-support-menu-template" target="_blank"><i class="material-icons">label_outline</i><span class="menu-title" data-i18n="Support Ticket">Support Ticket</span></a>
                </li>
                <li class=" nav-item"><a href="../material-bank-menu-template" target="_blank"><i class="material-icons">account_balance</i><span class="menu-title" data-i18n="Bank">Bank</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Apps">Apps</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Apps">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="app-todo.html"><i class="material-icons">playlist_add_check</i><span class="menu-title" data-i18n="ToDo">ToDo</span></a>
                </li>
                <li class=" nav-item"><a href="app-contacts.html"><i class="material-icons">people_outline</i><span class="menu-title" data-i18n="Contacts">Contacts</span></a>
                </li>
                <li class=" nav-item"><a href="app-email.html"><i class="material-icons">mail_outline</i><span class="menu-title" data-i18n="Email">Email</span></a>
                </li>
                <li class=" nav-item"><a href="app-chat.html"><i class="material-icons">chat_bubble_outline</i><span class="menu-title" data-i18n="Chat">Chat</span></a>
                </li>
                <li class=" nav-item"><a href="app-kanban.html"><i class="material-icons">playlist_add_check</i><span class="menu-title" data-i18n="Kanban">Kanban</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">playlist_add</i><span class="menu-title" data-i18n="Project">Project</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="project-summary.html"><i class="material-icons"></i><span data-i18n="Project Summary">Project Summary</span></a>
                        </li>
                        <li><a class="menu-item" href="project-tasks.html"><i class="material-icons"></i><span data-i18n="Project Task">Project Task</span></a>
                        </li>
                        <li><a class="menu-item" href="project-bugs.html"><i class="material-icons"></i><span data-i18n="Project Bugs">Project Bugs</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">event</i><span class="menu-title" data-i18n="Calendars">Calendars</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Full Calendar">Full Calendar</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="full-calender-basic.html"><i class="material-icons"></i><span data-i18n="Basic">Basic</span></a>
                                </li>
                                <li><a class="menu-item" href="full-calender-events.html"><i class="material-icons"></i><span data-i18n="Events">Events</span></a>
                                </li>
                                <li><a class="menu-item" href="full-calender-advance.html"><i class="material-icons"></i><span data-i18n="Advance">Advance</span></a>
                                </li>
                                <li><a class="menu-item" href="full-calender-extra.html"><i class="material-icons"></i><span data-i18n="Extra">Extra</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="calendars-clndr.html"><i class="material-icons"></i><span data-i18n="CLNDR">CLNDR</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Pages">Pages</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Pages">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="news-feed.html"><i class="material-icons">library_books</i><span class="menu-title" data-i18n="News Feed">News Feed</span></a>
                </li>
                <li class=" nav-item"><a href="social-feed.html"><i class="material-icons">stay_current_portrait</i><span class="menu-title" data-i18n="Social Feed">Social Feed</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">content_paste</i><span class="menu-title" data-i18n="Invoice">Invoice</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="invoice-summary.html"><i class="material-icons"></i><span data-i18n="Invoice Summary">Invoice Summary</span></a>
                        </li>
                        <li><a class="menu-item" href="invoice-template.html"><i class="material-icons"></i><span data-i18n="Invoice Template">Invoice Template</span></a>
                        </li>
                        <li><a class="menu-item" href="invoice-list.html"><i class="material-icons"></i><span data-i18n="Invoice List">Invoice List</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">timeline</i><span class="menu-title" data-i18n="Timelines">Timelines</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="timeline-center.html"><i class="material-icons"></i><span data-i18n="Timelines Center">Timelines Center</span></a>
                        </li>
                        <li><a class="menu-item" href="timeline-left.html"><i class="material-icons"></i><span data-i18n="Timelines Left">Timelines Left</span></a>
                        </li>
                        <li><a class="menu-item" href="timeline-right.html"><i class="material-icons"></i><span data-i18n="Timelines Right">Timelines Right</span></a>
                        </li>
                        <li><a class="menu-item" href="timeline-horizontal.html"><i class="material-icons"></i><span data-i18n="Timelines Horizontal">Timelines Horizontal</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="account-setting.html"><i class="material-icons">account_circle</i><span class="menu-title" data-i18n="Account Setting">Account Setting</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="Users">Users</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="page-users-list.html"><i class="material-icons"></i><span data-i18n="Users List">Users List</span></a>
                        </li>
                        <li><a class="menu-item" href="page-users-view.html"><i class="material-icons"></i><span data-i18n="Users View">Users View</span></a>
                        </li>
                        <li><a class="menu-item" href="page-users-edit.html"><i class="material-icons"></i><span data-i18n="Users Edit">Users Edit</span></a>
                        </li>
                        <li><a class="menu-item" href="user-profile.html"><i class="material-icons"></i><span data-i18n="Users Profile">Users Profile</span></a>
                        </li>
                        <li><a class="menu-item" href="user-cards.html"><i class="material-icons"></i><span data-i18n="Users Cards">Users Cards</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">wallpaper</i><span class="menu-title" data-i18n="Gallery">Gallery</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="gallery-grid.html"><i class="material-icons"></i><span data-i18n="Gallery Grid">Gallery Grid</span></a>
                        </li>
                        <li><a class="menu-item" href="gallery-grid-with-desc.html"><i class="material-icons"></i><span data-i18n="Gallery Grid with Desc">Gallery Grid with Desc</span></a>
                        </li>
                        <li><a class="menu-item" href="gallery-masonry.html"><i class="material-icons"></i><span data-i18n="Masonry Gallery">Masonry Gallery</span></a>
                        </li>
                        <li><a class="menu-item" href="gallery-masonry-with-desc.html"><i class="material-icons"></i><span data-i18n="Masonry Gallery with Desc">Masonry Gallery with Desc</span></a>
                        </li>
                        <li><a class="menu-item" href="gallery-hover-effects.html"><i class="material-icons"></i><span data-i18n="Hover Effects">Hover Effects</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">search</i><span class="menu-title" data-i18n="Search">Search</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="search-page.html"><i class="material-icons"></i><span data-i18n="Search Page">Search Page</span></a>
                        </li>
                        <li><a class="menu-item" href="search-website.html"><i class="material-icons"></i><span data-i18n="Search Website">Search Website</span></a>
                        </li>
                        <li><a class="menu-item" href="search-images.html"><i class="material-icons"></i><span data-i18n="Search Images">Search Images</span></a>
                        </li>
                        <li><a class="menu-item" href="search-videos.html"><i class="material-icons"></i><span data-i18n="Search Videos">Search Videos</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">lock_outline</i><span class="menu-title" data-i18n="Authentication">Authentication</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="login-simple.html" target="_blank"><i class="material-icons"></i><span data-i18n="Login Simple">Login Simple</span></a>
                        </li>
                        <li><a class="menu-item" href="login-with-bg.html" target="_blank"><i class="material-icons"></i><span data-i18n="Login with Bg">Login with Bg</span></a>
                        </li>
                        <li><a class="menu-item" href="login-with-bg-image.html" target="_blank"><i class="material-icons"></i><span data-i18n="Login with Bg Image">Login with Bg Image</span></a>
                        </li>
                        <li><a class="menu-item" href="login-with-navbar.html" target="_blank"><i class="material-icons"></i><span data-i18n="Login with Navbar">Login with Navbar</span></a>
                        </li>
                        <li><a class="menu-item" href="login-advanced.html" target="_blank"><i class="material-icons"></i><span data-i18n="Login Advanced">Login Advanced</span></a>
                        </li>
                        <li><a class="menu-item" href="register-simple.html" target="_blank"><i class="material-icons"></i><span data-i18n="Register Simple">Register Simple</span></a>
                        </li>
                        <li><a class="menu-item" href="register-with-bg.html" target="_blank"><i class="material-icons"></i><span data-i18n="Register with Bg">Register with Bg</span></a>
                        </li>
                        <li><a class="menu-item" href="register-with-bg-image.html" target="_blank"><i class="material-icons"></i><span data-i18n="Register with Bg Image">Register with Bg Image</span></a>
                        </li>
                        <li><a class="menu-item" href="register-with-navbar.html" target="_blank"><i class="material-icons"></i><span data-i18n="Register with Navbar">Register with Navbar</span></a>
                        </li>
                        <li><a class="menu-item" href="register-advanced.html" target="_blank"><i class="material-icons"></i><span data-i18n="Register Advanced">Register Advanced</span></a>
                        </li>
                        <li><a class="menu-item" href="unlock-user.html" target="_blank"><i class="material-icons"></i><span data-i18n="Unlock User">Unlock User</span></a>
                        </li>
                        <li><a class="menu-item" href="recover-password.html" target="_blank"><i class="material-icons"></i><span data-i18n="recover-password">recover-password</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">error_outline</i><span class="menu-title" data-i18n="Error">Error</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="error-400.html"><i class="material-icons"></i><span data-i18n="Error 400">Error 400</span></a>
                        </li>
                        <li><a class="menu-item" href="error-400-with-navbar.html"><i class="material-icons"></i><span data-i18n="Error 400 with Navbar">Error 400 with Navbar</span></a>
                        </li>
                        <li><a class="menu-item" href="error-401.html"><i class="material-icons"></i><span data-i18n="Error 401">Error 401</span></a>
                        </li>
                        <li><a class="menu-item" href="error-401-with-navbar.html"><i class="material-icons"></i><span data-i18n="Error 401 with Navbar">Error 401 with Navbar</span></a>
                        </li>
                        <li><a class="menu-item" href="error-403.html"><i class="material-icons"></i><span data-i18n="Error 403">Error 403</span></a>
                        </li>
                        <li><a class="menu-item" href="error-403-with-navbar.html"><i class="material-icons"></i><span data-i18n="Error 403 with Navbar">Error 403 with Navbar</span></a>
                        </li>
                        <li><a class="menu-item" href="error-404.html"><i class="material-icons"></i><span data-i18n="Error 404">Error 404</span></a>
                        </li>
                        <li><a class="menu-item" href="error-404-with-navbar.html"><i class="material-icons"></i><span data-i18n="Error 404 with Navbar">Error 404 with Navbar</span></a>
                        </li>
                        <li><a class="menu-item" href="error-500.html"><i class="material-icons"></i><span data-i18n="Error 500">Error 500</span></a>
                        </li>
                        <li><a class="menu-item" href="error-500-with-navbar.html"><i class="material-icons"></i><span data-i18n="Error 500 with Navbar">Error 500 with Navbar</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">filter_2</i><span class="menu-title" data-i18n="Others">Others</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Coming Soon">Coming Soon</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="coming-soon-flat.html"><i class="material-icons"></i><span data-i18n="Flat">Flat</span></a>
                                </li>
                                <li><a class="menu-item" href="coming-soon-bg-image.html"><i class="material-icons"></i><span data-i18n="Bg image">Bg image</span></a>
                                </li>
                                <li><a class="menu-item" href="coming-soon-bg-video.html"><i class="material-icons"></i><span data-i18n="Bg video">Bg video</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="under-maintenance.html"><i class="material-icons"></i><span data-i18n="Maintenance">Maintenance</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="pricing.html"><i class="material-icons">attach_money</i><span class="menu-title" data-i18n="Pricing">Pricing</span></a>
                </li>
                <li class=" nav-item"><a href="checkout-form.html"><i class="material-icons">credit_card</i><span class="menu-title" data-i18n="Checkout">Checkout</span></a>
                </li>
                <li class=" nav-item"><a href="faq.html"><i class="material-icons">help_outline</i><span class="menu-title" data-i18n="FAQ">FAQ</span></a>
                </li>
                <li class=" nav-item"><a href="knowledge-base.html"><i class="material-icons">info_outline</i><span class="menu-title" data-i18n="Knowledge Base">Knowledge Base</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Layouts">Layouts</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Layouts">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">grid_on</i><span class="menu-title" data-i18n="Page layouts">Page layouts</span><span class="badge badge badge-pill badge-danger float-right mr-2">New</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="layout-1-column.html"><i class="material-icons"></i><span data-i18n="1 column">1 column</span></a>
                        </li>
                        <li><a class="menu-item" href="layout-2-columns.html"><i class="material-icons"></i><span data-i18n="2 columns">2 columns</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Content Sidebar">Content Sidebar</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="layout-content-left-sidebar.html"><i class="material-icons"></i><span data-i18n="Left sidebar">Left sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="layout-content-left-sticky-sidebar.html"><i class="material-icons"></i><span data-i18n="Left sticky sidebar">Left sticky sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="layout-content-right-sidebar.html"><i class="material-icons"></i><span data-i18n="Right sidebar">Right sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="layout-content-right-sticky-sidebar.html"><i class="material-icons"></i><span data-i18n="Right sticky sidebar">Right sticky sidebar</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Content Det. Sidebar">Content Det. Sidebar</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="layout-content-detached-left-sidebar.html"><i class="material-icons"></i><span data-i18n="Detached left sidebar">Detached left sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="layout-content-detached-left-sticky-sidebar.html"><i class="material-icons"></i><span data-i18n="Detached sticky left sidebar">Detached sticky left sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="layout-content-detached-right-sidebar.html"><i class="material-icons"></i><span data-i18n="Detached right sidebar">Detached right sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="layout-content-detached-right-sticky-sidebar.html"><i class="material-icons"></i><span data-i18n="Detached sticky right sidebar">Detached sticky right sidebar</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="navigation-divider"></li>
                        <li><a class="menu-item" href="layout-fixed-navbar.html"><i class="material-icons"></i><span data-i18n="Fixed navbar">Fixed navbar</span></a>
                        </li>
                        <li><a class="menu-item" href="layout-fixed-navigation.html"><i class="material-icons"></i><span data-i18n="Fixed navigation">Fixed navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="layout-fixed-navbar-navigation.html"><i class="material-icons"></i><span data-i18n="Fixed navbar &amp; navigation">Fixed navbar &amp; navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="layout-fixed-navbar-footer.html"><i class="material-icons"></i><span data-i18n="Fixed navbar &amp; footer">Fixed navbar &amp; footer</span></a>
                        </li>
                        <li class="navigation-divider"></li>
                        <li><a class="menu-item" href="layout-fixed.html"><i class="material-icons"></i><span data-i18n="Fixed layout">Fixed layout</span></a>
                        </li>
                        <li><a class="menu-item" href="layout-boxed.html"><i class="material-icons"></i><span data-i18n="Boxed layout">Boxed layout</span></a>
                        </li>
                        <li><a class="menu-item" href="layout-static.html"><i class="material-icons"></i><span data-i18n="Static layout">Static layout</span></a>
                        </li>
                        <li class="navigation-divider"></li>
                        <li><a class="menu-item" href="layout-light.html"><i class="material-icons"></i><span data-i18n="Light layout">Light layout</span></a>
                        </li>
                        <li><a class="menu-item" href="layout-dark.html"><i class="material-icons"></i><span data-i18n="Dark layout">Dark layout</span></a>
                        </li>
                        <li><a class="menu-item" href="layout-semi-dark.html"><i class="material-icons"></i><span data-i18n="Semi dark layout">Semi dark layout</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">menu</i><span class="menu-title" data-i18n="Navbars">Navbars</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="navbar-light.html"><i class="material-icons"></i><span data-i18n="Navbar Light">Navbar Light</span></a>
                        </li>
                        <li><a class="menu-item" href="navbar-dark.html"><i class="material-icons"></i><span data-i18n="Navbar Dark">Navbar Dark</span></a>
                        </li>
                        <li><a class="menu-item" href="navbar-semi-dark.html"><i class="material-icons"></i><span data-i18n="Navbar Semi Dark">Navbar Semi Dark</span></a>
                        </li>
                        <li><a class="menu-item" href="navbar-brand-center.html"><i class="material-icons"></i><span data-i18n="Brand Center">Brand Center</span></a>
                        </li>
                        <li><a class="menu-item" href="navbar-fixed-top.html"><i class="material-icons"></i><span data-i18n="Fixed Top">Fixed Top</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Hide on Scroll">Hide on Scroll</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="navbar-hide-on-scroll-top.html"><i class="material-icons"></i><span data-i18n="Hide on Scroll Top">Hide on Scroll Top</span></a>
                                </li>
                                <li><a class="menu-item" href="navbar-hide-on-scroll-bottom.html"><i class="material-icons"></i><span data-i18n="Hide on Scroll Bottom">Hide on Scroll Bottom</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="navbar-components.html"><i class="material-icons"></i><span data-i18n="Navbar Components">Navbar Components</span></a>
                        </li>
                        <li><a class="menu-item" href="navbar-styling.html"><i class="material-icons"></i><span data-i18n="Navbar Styling">Navbar Styling</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">arrow_downward</i><span class="menu-title" data-i18n="Vertical Nav">Vertical Nav</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Navigation Types">Navigation Types</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="../material-vertical-menu-template"><i class="material-icons"></i><span data-i18n="Vertical Menu">Vertical Menu</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-modern-menu-template"><i class="material-icons"></i><span data-i18n="Vertical Modern Menu">Vertical Modern Menu</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-overlay-menu-template"><i class="material-icons"></i><span data-i18n="Vertical Overlay">Vertical Overlay</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-compact-menu-template"><i class="material-icons"></i><span data-i18n="Vertical Compact">Vertical Compact</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-vertical-content-menu-template"><i class="material-icons"></i><span data-i18n="Vertical Content">Vertical Content</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-fixed.html"><i class="material-icons"></i><span data-i18n="Fixed Navigation">Fixed Navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-static.html"><i class="material-icons"></i><span data-i18n="Static Navigation">Static Navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-light.html"><i class="material-icons"></i><span data-i18n="Navigation Light">Navigation Light</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-dark.html"><i class="material-icons"></i><span data-i18n="Navigation Dark">Navigation Dark</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-accordion.html"><i class="material-icons"></i><span data-i18n="Accordion Navigation">Accordion Navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-collapsible.html"><i class="material-icons"></i><span data-i18n="Collapsible Navigation">Collapsible Navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-flipped.html"><i class="material-icons"></i><span data-i18n="Flipped Navigation">Flipped Navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-native-scroll.html"><i class="material-icons"></i><span data-i18n="Native scroll">Native scroll</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-right-side-icon.html"><i class="material-icons"></i><span data-i18n="Right side icons">Right side icons</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-bordered.html"><i class="material-icons"></i><span data-i18n="Bordered Navigation">Bordered Navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-disabled-link.html"><i class="material-icons"></i><span data-i18n="Disabled Navigation">Disabled Navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-styling.html"><i class="material-icons"></i><span data-i18n="Navigation Styling">Navigation Styling</span></a>
                        </li>
                        <li><a class="menu-item" href="vertical-nav-tags-pills.html"><i class="material-icons"></i><span data-i18n="Tags &amp; Pills">Tags &amp; Pills</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">arrow_forward</i><span class="menu-title" data-i18n="Horizontal Nav">Horizontal Nav</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Navigation Types">Navigation Types</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="../material-horizontal-menu-template"><i class="material-icons"></i><span data-i18n="Left Icon Navigation">Left Icon Navigation</span></a>
                                </li>
                                <li><a class="menu-item" href="../material-horizontal-menu-template-nav"><i class="material-icons"></i><span data-i18n="Top Icon Navigation">Top Icon Navigation</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">local_parking</i><span class="menu-title" data-i18n="Page Headers">Page Headers</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="headers-breadcrumbs-basic.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs basic">Breadcrumbs basic</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-top.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs top">Breadcrumbs top</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-bottom.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs bottom">Breadcrumbs bottom</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-top-with-description.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs top with desc">Breadcrumbs top with desc</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-with-button.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs with button">Breadcrumbs with button</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-with-round-button.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs with button 2">Breadcrumbs with button 2</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-with-button-group.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs with buttons">Breadcrumbs with buttons</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-with-description.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs with desc">Breadcrumbs with desc</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-with-search.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs with search">Breadcrumbs with search</span></a>
                        </li>
                        <li><a class="menu-item" href="headers-breadcrumbs-with-stats.html"><i class="material-icons"></i><span data-i18n="Breadcrumbs with stats">Breadcrumbs with stats</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">copyright</i><span class="menu-title" data-i18n="Footers">Footers</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="footer-light.html"><i class="material-icons"></i><span data-i18n="Footer Light">Footer Light</span></a>
                        </li>
                        <li><a class="menu-item" href="footer-dark.html"><i class="material-icons"></i><span data-i18n="Footer Dark">Footer Dark</span></a>
                        </li>
                        <li><a class="menu-item" href="footer-transparent.html"><i class="material-icons"></i><span data-i18n="Footer Transparent">Footer Transparent</span></a>
                        </li>
                        <li><a class="menu-item" href="footer-fixed.html"><i class="material-icons"></i><span data-i18n="Footer Fixed">Footer Fixed</span></a>
                        </li>
                        <li><a class="menu-item" href="footer-components.html"><i class="material-icons"></i><span data-i18n="Footer Components">Footer Components</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="General">General</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="General">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">brush</i><span class="menu-title" data-i18n="Color Palette">Color Palette</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="color-palette-primary.html"><i class="material-icons"></i><span data-i18n="Primary palette">Primary palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-danger.html"><i class="material-icons"></i><span data-i18n="Danger palette">Danger palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-success.html"><i class="material-icons"></i><span data-i18n="Success palette">Success palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-warning.html"><i class="material-icons"></i><span data-i18n="Warning palette">Warning palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-info.html"><i class="material-icons"></i><span data-i18n="Info palette">Info palette</span></a>
                        </li>
                        <li class="navigation-divider"></li>
                        <li><a class="menu-item" href="color-palette-red.html"><i class="material-icons"></i><span data-i18n="Red palette">Red palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-pink.html"><i class="material-icons"></i><span data-i18n="Pink palette">Pink palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-purple.html"><i class="material-icons"></i><span data-i18n="Purple palette">Purple palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-blue.html"><i class="material-icons"></i><span data-i18n="Blue palette">Blue palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-cyan.html"><i class="material-icons"></i><span data-i18n="Cyan palette">Cyan palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-teal.html"><i class="material-icons"></i><span data-i18n="Teal palette">Teal palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-yellow.html"><i class="material-icons"></i><span data-i18n="Yellow palette">Yellow palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-amber.html"><i class="material-icons"></i><span data-i18n="Amber palette">Amber palette</span></a>
                        </li>
                        <li><a class="menu-item" href="color-palette-blue-grey.html"><i class="material-icons"></i><span data-i18n="Blue Grey palette">Blue Grey palette</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">code</i><span class="menu-title" data-i18n="Starter kit">Starter kit</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-1-column.html"><i class="material-icons"></i><span data-i18n="1 column">1 column</span></a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-2-columns.html"><i class="material-icons"></i><span data-i18n="2 columns">2 columns</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Content Det. Sidebar">Content Det. Sidebar</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-content-detached-left-sidebar.html"><i class="material-icons"></i><span data-i18n="Detached left sidebar">Detached left sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-content-detached-left-sticky-sidebar.html"><i class="material-icons"></i><span data-i18n="Detached sticky left sidebar">Detached sticky left sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-content-detached-right-sidebar.html"><i class="material-icons"></i><span data-i18n="Detached right sidebar">Detached right sidebar</span></a>
                                </li>
                                <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-content-detached-right-sticky-sidebar.html"><i class="material-icons"></i><span data-i18n="Detached sticky right sidebar">Detached sticky right sidebar</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="navigation-divider"></li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-fixed-navbar.html"><i class="material-icons"></i><span data-i18n="Fixed navbar">Fixed navbar</span></a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-fixed-navigation.html"><i class="material-icons"></i><span data-i18n="Fixed navigation">Fixed navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-fixed-navbar-navigation.html"><i class="material-icons"></i><span data-i18n="Fixed navbar &amp; navigation">Fixed navbar &amp; navigation</span></a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-fixed-navbar-footer.html"><i class="material-icons"></i><span data-i18n="Fixed navbar &amp; footer">Fixed navbar &amp; footer</span></a>
                        </li>
                        <li class="navigation-divider"></li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-fixed.html"><i class="material-icons"></i><span data-i18n="Fixed layout">Fixed layout</span></a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-boxed.html"><i class="material-icons"></i><span data-i18n="Boxed layout">Boxed layout</span></a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-static.html"><i class="material-icons"></i><span data-i18n="Static layout">Static layout</span></a>
                        </li>
                        <li class="navigation-divider"></li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-light.html"><i class="material-icons"></i><span data-i18n="Light layout">Light layout</span></a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-dark.html"><i class="material-icons"></i><span data-i18n="Dark layout">Dark layout</span></a>
                        </li>
                        <li><a class="menu-item" href="../../../starter-kit/rtl/material-vertical-menu-template/layout-semi-dark.html"><i class="material-icons"></i><span data-i18n="Semi dark layout">Semi dark layout</span></a>
                        </li>
                    </ul>
                </li>
                <li class="disabled nav-item"><a href="#"><i class="material-icons">visibility_off</i><span class="menu-title" data-i18n="Disabled Menu">Disabled Menu</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Menu levels">Menu levels</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Second level">Second level</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Second level child">Second level child</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Third level">Third level</span></a>
                                </li>
                                <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Third level child">Third level child</span></a>
                                    <ul class="menu-content">
                                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Fourth level">Fourth level</span></a>
                                        </li>
                                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Fourth level">Fourth level</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="User Interface">User Interface</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="User Interface">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">straighten</i><span class="menu-title" data-i18n="Material Components">Material Components</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="material-component-buttons.html"><i class="material-icons"></i><span data-i18n="Buttons">Buttons</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-cards.html"><i class="material-icons"></i><span data-i18n="Cards">Cards</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-chips.html"><i class="material-icons"></i><span data-i18n="Chips">Chips</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-datatables.html"><i class="material-icons"></i><span data-i18n="Data tables">Data tables</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-dialogs.html"><i class="material-icons"></i><span data-i18n="Dialogs">Dialogs</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-elevation-shadows.html"><i class="material-icons"></i><span data-i18n="Elevation Shadows">Elevation Shadows</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-expansion-panels.html"><i class="material-icons"></i><span data-i18n="Expansion Panels">Expansion Panels</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-icons.html"><i class="material-icons"></i><span data-i18n="Icons">Icons</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-menu.html"><i class="material-icons"></i><span data-i18n="Menu">Menu</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-navigation.html"><i class="material-icons"></i><span data-i18n="Navigation Drawer">Navigation Drawer</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-pickers.html"><i class="material-icons"></i><span data-i18n="Pickers">Pickers</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-progress.html"><i class="material-icons"></i><span data-i18n="Progress">Progress</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-selection-controls.html"><i class="material-icons"></i><span data-i18n="Selection Controls">Selection Controls</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-snackbars.html"><i class="material-icons"></i><span data-i18n="Snackbars">Snackbars</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-steppers.html"><i class="material-icons"></i><span data-i18n="Steppers">Steppers</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-tabs.html"><i class="material-icons"></i><span data-i18n="Tabs">Tabs</span></a>
                        </li>
                        <li><a class="menu-item" href="material-component-textfields.html"><i class="material-icons"> </i><span data-i18n="Text fields">Text fields</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">crop_landscape</i><span class="menu-title" data-i18n="Cards">Cards</span><span class="badge badge badge-success float-right mr-2">New</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="card-bootstrap.html"><i class="material-icons"></i><span data-i18n="Bootstrap">Bootstrap</span></a>
                        </li>
                        <li><a class="menu-item" href="card-headings.html"><i class="material-icons"></i><span data-i18n="Headings">Headings</span></a>
                        </li>
                        <li><a class="menu-item" href="card-options.html"><i class="material-icons"></i><span data-i18n="Options">Options</span></a>
                        </li>
                        <li><a class="menu-item" href="card-actions.html"><i class="material-icons"></i><span data-i18n="Action">Action</span></a>
                        </li>
                        <li><a class="menu-item" href="card-draggable.html"><i class="material-icons"></i><span data-i18n="Draggable">Draggable</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">star_border</i><span class="menu-title" data-i18n="Advance Cards">Advance Cards</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="card-statistics.html"><i class="material-icons"></i><span data-i18n="Statistics">Statistics</span></a>
                        </li>
                        <li><a class="menu-item" href="card-weather.html"><i class="material-icons"></i><span data-i18n="Weather">Weather</span></a>
                        </li>
                        <li><a class="menu-item" href="card-charts.html"><i class="material-icons"></i><span data-i18n="Charts">Charts</span></a>
                        </li>
                        <li><a class="menu-item" href="card-interactive.html"><i class="material-icons"></i><span data-i18n="Interactive">Interactive</span></a>
                        </li>
                        <li><a class="menu-item" href="card-maps.html"><i class="material-icons"></i><span data-i18n="Maps">Maps</span></a>
                        </li>
                        <li><a class="menu-item" href="card-social.html"><i class="material-icons"></i><span data-i18n="Social">Social</span></a>
                        </li>
                        <li><a class="menu-item" href="card-ecommerce.html"><i class="material-icons"></i><span data-i18n="E-Commerce">E-Commerce</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">details</i><span class="menu-title" data-i18n="Content">Content</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="content-grid.html"><i class="material-icons"></i><span data-i18n="Grid">Grid</span></a>
                        </li>
                        <li><a class="menu-item" href="content-typography.html"><i class="material-icons"></i><span data-i18n="Typography">Typography</span></a>
                        </li>
                        <li><a class="menu-item" href="content-text-utilities.html"><i class="material-icons"></i><span data-i18n="Text utilities">Text utilities</span></a>
                        </li>
                        <li><a class="menu-item" href="content-syntax-highlighter.html"><i class="material-icons"></i><span data-i18n="Syntax highlighter">Syntax highlighter</span></a>
                        </li>
                        <li><a class="menu-item" href="content-helper-classes.html"><i class="material-icons"></i><span data-i18n="Helper classes">Helper classes</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">dvr</i><span class="menu-title" data-i18n="Components">Components</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="component-alerts.html"><i class="material-icons"></i><span data-i18n="Alerts">Alerts</span></a>
                        </li>
                        <li><a class="menu-item" href="component-callout.html"><i class="material-icons"></i><span data-i18n="Callout">Callout</span></a>
                        </li>
                        <li><a class="menu-item" href="component-buttons-basic.html"><i class="material-icons"></i><span data-i18n="Buttons">Buttons</span></a>
                        </li>
                        <li><a class="menu-item" href="component-carousel.html"><i class="material-icons"></i><span data-i18n="Carousel">Carousel</span></a>
                        </li>
                        <li><a class="menu-item" href="component-collapse.html"><i class="material-icons"></i><span data-i18n="Collapse">Collapse</span></a>
                        </li>
                        <li><a class="menu-item" href="component-dropdowns.html"><i class="material-icons"></i><span data-i18n="Dropdowns">Dropdowns</span></a>
                        </li>
                        <li><a class="menu-item" href="component-list-group.html"><i class="material-icons"></i><span data-i18n="List Group">List Group</span></a>
                        </li>
                        <li><a class="menu-item" href="component-modals.html"><i class="material-icons"></i><span data-i18n="Modals">Modals</span></a>
                        </li>
                        <li><a class="menu-item" href="component-pagination.html"><i class="material-icons"></i><span data-i18n="Pagination">Pagination</span></a>
                        </li>
                        <li><a class="menu-item" href="component-navs-component.html"><i class="material-icons"></i><span data-i18n="Navs Component">Navs Component</span></a>
                        </li>
                        <li><a class="menu-item" href="component-tabs-component.html"><i class="material-icons"></i><span data-i18n="Tabs Component">Tabs Component</span></a>
                        </li>
                        <li><a class="menu-item" href="component-pills-component.html"><i class="material-icons"></i><span data-i18n="Pills Component">Pills Component</span></a>
                        </li>
                        <li><a class="menu-item" href="component-tooltips.html"><i class="material-icons"></i><span data-i18n="Tooltips">Tooltips</span></a>
                        </li>
                        <li><a class="menu-item" href="component-popovers.html"><i class="material-icons"></i><span data-i18n="Popovers">Popovers</span></a>
                        </li>
                        <li><a class="menu-item" href="component-badges.html"><i class="material-icons"></i><span data-i18n="Badges">Badges</span></a>
                        </li>
                        <li><a class="menu-item" href="component-pill-badges.html"><i class="material-icons"></i><span>Pill Badges</span></a>
                        </li>
                        <li><a class="menu-item" href="component-progress.html"><i class="material-icons"></i><span data-i18n="Progress">Progress</span></a>
                        </li>
                        <li><a class="menu-item" href="component-media-objects.html"><i class="material-icons"></i><span data-i18n="Media Objects">Media Objects</span></a>
                        </li>
                        <li><a class="menu-item" href="component-scrollable.html"><i class="material-icons"></i><span data-i18n="Scrollable">Scrollable</span></a>
                        </li>
                        <li><a class="menu-item" href="component-spinners.html"><i class="material-icons"></i><span data-i18n="Spinners">Spinners</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">track_changes</i><span class="menu-title" data-i18n="Extra Components">Extra Components</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="ex-component-sweet-alerts.html"><i class="material-icons"></i><span data-i18n="Sweet Alerts">Sweet Alerts</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-tree-views.html"><i class="material-icons"></i><span data-i18n="Tree Views">Tree Views</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-toastr.html"><i class="material-icons"></i><span data-i18n="Toastr">Toastr</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-ratings.html"><i class="material-icons"></i><span data-i18n="Ratings">Ratings</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-noui-slider.html"><i class="material-icons"></i><span data-i18n="NoUI Slider">NoUI Slider</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-date-time-dropper.html"><i class="material-icons"></i><span data-i18n="Date Time Dropper">Date Time Dropper</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-lists.html"><i class="material-icons"></i><span data-i18n="Lists">Lists</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-toolbar.html"><i class="material-icons"></i><span data-i18n="Toolbar">Toolbar</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-knob.html"><i class="material-icons"></i><span data-i18n="Knob">Knob</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-long-press.html"><i class="material-icons"></i><span data-i18n="Long Press">Long Press</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-offline.html"><i class="material-icons"></i><span data-i18n="Offline">Offline</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-zoom.html"><i class="material-icons"></i><span data-i18n="Zoom">Zoom</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-media-player.html"><i class="material-icons"></i><span data-i18n="media Player">media Player</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-tour.html"><i class="material-icons"></i><span data-i18n="Tour">Tour</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-swiper.html"><i class="material-icons"></i><span data-i18n="Swiper">Swiper</span></a>
                        </li>
                        <li><a class="menu-item" href="ex-component-avatar.html"><i class="material-icons"></i><span data-i18n="Avatar">Avatar</span></a>
                        </li>
                        <li><a class="menu-item" href="miscellaneous.html"><i class="material-icons"></i><span data-i18n="Miscellaneous">Miscellaneous</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="animation.html"><i class="material-icons">hdr_weak</i><span class="menu-title" data-i18n="Animation">Animation</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Forms">Forms</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Forms">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">format_list_bulleted</i><span class="menu-title" data-i18n="Form Elements">Form Elements</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="form-inputs.html"><i class="material-icons"></i><span data-i18n="Form Inputs">Form Inputs</span></a>
                        </li>
                        <li><a class="menu-item" href="form-input-groups.html"><i class="material-icons"></i><span data-i18n="Input Groups">Input Groups</span></a>
                        </li>
                        <li><a class="menu-item" href="form-input-grid.html"><i class="material-icons"></i><span data-i18n="Input Grid">Input Grid</span></a>
                        </li>
                        <li><a class="menu-item" href="form-extended-inputs.html"><i class="material-icons"></i><span data-i18n="Extended Inputs">Extended Inputs</span></a>
                        </li>
                        <li><a class="menu-item" href="form-checkboxes-radios.html"><i class="material-icons"></i><span data-i18n="Checkboxes &amp; Radios">Checkboxes &amp; Radios</span></a>
                        </li>
                        <li><a class="menu-item" href="form-switch.html"><i class="material-icons"></i><span data-i18n="Switch">Switch</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Select">Select</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="form-select2.html"><i class="material-icons"></i><span data-i18n="Select2">Select2</span></a>
                                </li>
                                <li><a class="menu-item" href="form-selectize.html"><i class="material-icons"></i><span data-i18n="Selectize">Selectize</span></a>
                                </li>
                                <li><a class="menu-item" href="form-selectivity.html"><i class="material-icons"></i><span data-i18n="Selectivity">Selectivity</span></a>
                                </li>
                                <li><a class="menu-item" href="form-select-box-it.html"><i class="material-icons"></i><span data-i18n="Select Box It">Select Box It</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="form-dual-listbox.html"><i class="material-icons"></i><span data-i18n="Dual Listbox">Dual Listbox</span></a>
                        </li>
                        <li><a class="menu-item" href="form-tags-input.html"><i class="material-icons"></i><span data-i18n="Tags Input">Tags Input</span></a>
                        </li>
                        <li><a class="menu-item" href="form-validation.html"><i class="material-icons"></i><span data-i18n="Validation">Validation</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">grid_on</i><span class="menu-title" data-i18n="Form Layouts">Form Layouts</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="form-layout-basic.html"><i class="material-icons"></i><span data-i18n="Basic Forms">Basic Forms</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-horizontal.html"><i class="material-icons"></i><span data-i18n="Horizontal Forms">Horizontal Forms</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-hidden-labels.html"><i class="material-icons"></i><span data-i18n="Hidden Labels">Hidden Labels</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-form-actions.html"><i class="material-icons"></i><span data-i18n="Form Actions">Form Actions</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-row-separator.html"><i class="material-icons"></i><span data-i18n="Row Separator">Row Separator</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-bordered.html"><i class="material-icons"></i><span data-i18n="Bordered">Bordered</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-striped-rows.html"><i class="material-icons"></i><span data-i18n="Striped Rows">Striped Rows</span></a>
                        </li>
                        <li><a class="menu-item" href="form-layout-striped-labels.html"><i class="material-icons"></i><span data-i18n="Striped Labels">Striped Labels</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">linear_scale</i><span class="menu-title" data-i18n="Form Wizard">Form Wizard</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="form-wizard-circle-style.html"><i class="material-icons"></i><span data-i18n="Circle Style">Circle Style</span></a>
                        </li>
                        <li><a class="menu-item" href="form-wizard-notification-style.html"><i class="material-icons"></i><span data-i18n="Notification Style">Notification Style</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="form-repeater.html"><i class="material-icons">repeat</i><span class="menu-title" data-i18n="Form Repeater">Form Repeater</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Tables">Tables</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Tables">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">format_list_numbered</i><span class="menu-title" data-i18n="Bootstrap Tables">Bootstrap Tables</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="table-basic.html"><i class="material-icons"></i><span data-i18n="Basic Tables">Basic Tables</span></a>
                        </li>
                        <li><a class="menu-item" href="table-border.html"><i class="material-icons"></i><span data-i18n="Table Border">Table Border</span></a>
                        </li>
                        <li><a class="menu-item" href="table-sizing.html"><i class="material-icons"></i><span data-i18n="Table Sizing">Table Sizing</span></a>
                        </li>
                        <li><a class="menu-item" href="table-styling.html"><i class="material-icons"></i><span data-i18n="Table Styling">Table Styling</span></a>
                        </li>
                        <li><a class="menu-item" href="table-components.html"><i class="material-icons"></i><span data-i18n="Table Components">Table Components</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">select_all</i><span class="menu-title" data-i18n="DataTables">DataTables</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="dt-basic-initialization.html"><i class="material-icons"></i><span data-i18n="Basic Initialisation">Basic Initialisation</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-advanced-initialization.html"><i class="material-icons"></i><span data-i18n="Advanced initialisation">Advanced initialisation</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-styling.html"><i class="material-icons"></i><span data-i18n="Styling">Styling</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-data-sources.html"><i class="material-icons"></i><span data-i18n="Data Sources">Data Sources</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-api.html"><i class="material-icons"></i><span data-i18n="API">API</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">border_all</i><span class="menu-title" data-i18n="DataTables Ext.">DataTables Ext.</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="dt-extensions-autofill.html"><i class="material-icons"></i><span data-i18n="AutoFill">AutoFill</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Buttons">Buttons</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="dt-extensions-buttons-basic.html"><i class="material-icons"></i><span data-i18n="Basic Buttons">Basic Buttons</span></a>
                                </li>
                                <li><a class="menu-item" href="dt-extensions-buttons-html-5-data-export.html"><i class="material-icons"></i><span data-i18n="HTML 5 Data Export">HTML 5 Data Export</span></a>
                                </li>
                                <li><a class="menu-item" href="dt-extensions-buttons-flash-data-export.html"><i class="material-icons"></i><span data-i18n="Flash Data Export">Flash Data Export</span></a>
                                </li>
                                <li><a class="menu-item" href="dt-extensions-buttons-column-visibility.html"><i class="material-icons"></i><span data-i18n="Column Visibility">Column Visibility</span></a>
                                </li>
                                <li><a class="menu-item" href="dt-extensions-buttons-print.html"><i class="material-icons"></i><span data-i18n="Print">Print</span></a>
                                </li>
                                <li><a class="menu-item" href="dt-extensions-buttons-api.html"><i class="material-icons"></i><span data-i18n="API">API</span></a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="menu-item" href="dt-extensions-column-reorder.html"><i class="material-icons"></i><span data-i18n="Column Reorder">Column Reorder</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-extensions-fixed-columns.html"><i class="material-icons"></i><span data-i18n="Fixed Columns">Fixed Columns</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-extensions-key-table.html"><i class="material-icons"></i><span data-i18n="Key Table">Key Table</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-extensions-row-reorder.html"><i class="material-icons"></i><span data-i18n="Row Reorder">Row Reorder</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-extensions-select.html"><i class="material-icons"></i><span data-i18n="Select">Select</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-extensions-fix-header.html"><i class="material-icons"></i><span data-i18n="Fix Header">Fix Header</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-extensions-responsive.html"><i class="material-icons"></i><span data-i18n="Responsive">Responsive</span></a>
                        </li>
                        <li><a class="menu-item" href="dt-extensions-column-visibility.html"><i class="material-icons"></i><span data-i18n="Column Visibility">Column Visibility</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Add Ons">Add Ons</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Add Ons">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">edit</i><span class="menu-title" data-i18n="Editors">Editors</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="editor-quill.html"><i class="material-icons"></i><span data-i18n="Quill">Quill</span></a>
                        </li>
                        <li><a class="menu-item" href="editor-ckeditor.html"><i class="material-icons"></i><span data-i18n="CKEditor">CKEditor</span></a>
                        </li>
                        <li><a class="menu-item" href="editor-summernote.html"><i class="material-icons"></i><span data-i18n="Summernote">Summernote</span></a>
                        </li>
                        <li><a class="menu-item" href="editor-tinymce.html"><i class="material-icons"></i><span data-i18n="TinyMCE">TinyMCE</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Code Editor">Code Editor</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="code-editor-codemirror.html"><i class="material-icons"></i><span data-i18n="CodeMirror">CodeMirror</span></a>
                                </li>
                                <li><a class="menu-item" href="code-editor-ace.html"><i class="material-icons"></i><span data-i18n="Ace">Ace</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="pickers-color-picker.html"><i class="material-icons">color_lens</i><span class="menu-title" data-i18n="Color Picker">Color Picker</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">code</i><span class="menu-title" data-i18n="jQuery UI">jQuery UI</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="jquery-ui-interactions.html"><i class="material-icons"></i><span data-i18n="Interactions">Interactions</span></a>
                        </li>
                        <li><a class="menu-item" href="jquery-ui-navigations.html"><i class="material-icons"></i><span data-i18n="Navigations">Navigations</span></a>
                        </li>
                        <li><a class="menu-item" href="jquery-ui-date-pickers.html"><i class="material-icons"></i><span data-i18n="Date Pickers">Date Pickers</span></a>
                        </li>
                        <li><a class="menu-item" href="jquery-ui-autocomplete.html"><i class="material-icons"></i><span data-i18n="Autocomplete">Autocomplete</span></a>
                        </li>
                        <li><a class="menu-item" href="jquery-ui-buttons-select.html"><i class="material-icons"></i><span data-i18n="Buttons &amp; Select">Buttons &amp; Select</span></a>
                        </li>
                        <li><a class="menu-item" href="jquery-ui-slider-spinner.html"><i class="material-icons"></i><span data-i18n="Slider &amp; Spinner">Slider &amp; Spinner</span></a>
                        </li>
                        <li><a class="menu-item" href="jquery-ui-dialog-tooltip.html"><i class="material-icons"></i><span data-i18n="Dialog &amp; Tooltip">Dialog &amp; Tooltip</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="add-on-block-ui.html"><i class="material-icons">aspect_ratio</i><span class="menu-title" data-i18n="Block UI">Block UI</span></a>
                </li>
                <li class=" nav-item"><a href="add-on-image-cropper.html"><i class="material-icons">crop</i><span class="menu-title" data-i18n="Image Cropper">Image Cropper</span></a>
                </li>
                <li class=" nav-item"><a href="add-on-drag-drop.html"><i class="material-icons">open_with</i><span class="menu-title" data-i18n="Drag &amp; Drop">Drag &amp; Drop</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">open_in_browser</i><span class="menu-title" data-i18n="File Uploader">File Uploader</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="file-uploader-dropzone.html"><i class="material-icons"></i><span data-i18n="Dropzone">Dropzone</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="internationalization.html"><i class="material-icons">language</i><span class="menu-title" data-i18n="Internationalization">Internationalization</span></a>
                </li>
                <li class=" navigation-header"><span data-i18n="Charts &amp; Maps">Charts &amp; Maps</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Charts &amp; Maps">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="charts-apexcharts.html"><i class="material-icons">data_usage</i><span class="menu-title" data-i18n="Apex Charts">Apex Charts</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">show_chart</i><span class="menu-title" data-i18n="Chartjs">Chartjs</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="chartjs-line-charts.html"><i class="material-icons"></i><span data-i18n="Line charts">Line charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-bar-charts.html"><i class="material-icons"></i><span data-i18n="Bar charts">Bar charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-pie-doughnut-charts.html"><i class="material-icons"></i><span data-i18n="Pie &amp; Doughnut charts">Pie &amp; Doughnut charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-scatter-charts.html"><i class="material-icons"></i><span data-i18n="Scatter charts">Scatter charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-polar-radar-charts.html"><i class="material-icons"></i><span data-i18n="Polar &amp; Radar charts">Polar &amp; Radar charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartjs-advance-charts.html"><i class="material-icons"></i><span data-i18n="Advance charts">Advance charts</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">multiline_chart</i><span class="menu-title" data-i18n="D3 Charts">D3 Charts</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="d3-line-chart.html"><i class="material-icons"></i><span data-i18n="Line Chart">Line Chart</span></a>
                        </li>
                        <li><a class="menu-item" href="d3-bar-chart.html"><i class="material-icons"></i><span data-i18n="Bar Chart">Bar Chart</span></a>
                        </li>
                        <li><a class="menu-item" href="d3-pie-chart.html"><i class="material-icons"></i><span data-i18n="Pie Chart">Pie Chart</span></a>
                        </li>
                        <li><a class="menu-item" href="d3-circle-diagrams.html"><i class="material-icons"></i><span data-i18n="Circle Diagrams">Circle Diagrams</span></a>
                        </li>
                        <li><a class="menu-item" href="d3-tree-chart.html"><i class="material-icons"></i><span data-i18n="Tree Chart">Tree Chart</span></a>
                        </li>
                        <li><a class="menu-item" href="d3-other-charts.html"><i class="material-icons"></i><span data-i18n="Other Charts">Other Charts</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">pie_chart_outlined</i><span class="menu-title" data-i18n="Chartist">Chartist</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="chartist-line-charts.html"><i class="material-icons"></i><span data-i18n="Line charts">Line charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartist-bar-charts.html"><i class="material-icons"></i><span data-i18n="Bar charts">Bar charts</span></a>
                        </li>
                        <li><a class="menu-item" href="chartist-pie-charts.html"><i class="material-icons"></i><span data-i18n="Pie charts">Pie charts</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="morris-charts.html"><i class="material-icons">timeline</i><span class="menu-title" data-i18n="Morris Charts">Morris Charts</span></a>
                </li>
                <li class=" nav-item"><a href="rickshaw-charts.html"><i class="material-icons">track_changes</i><span class="menu-title" data-i18n="Rickshaw Charts">Rickshaw Charts</span></a>
                </li>
                <li class=" nav-item"><a href="#"><i class="material-icons">center_focus_weak</i><span class="menu-title" data-i18n="Maps">Maps</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="maps-leaflet.html"><i class="material-icons"></i><span data-i18n="Leaflet Maps">Leaflet Maps</span></a>
                        </li>
                        <li><a class="menu-item" href="#"><i class="material-icons"></i><span data-i18n="Vector Maps">Vector Maps</span></a>
                            <ul class="menu-content">
                                <li><a class="menu-item" href="vector-maps-jvector.html"><i class="material-icons"></i><span data-i18n="jVector Map">jVector Map</span></a>
                                </li>
                                <li><a class="menu-item" href="vector-maps-jvq.html"><i class="material-icons"></i><span data-i18n="JQV Map">JQV Map</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class=" navigation-header"><span data-i18n="Support">Support</span><i class="material-icons nav-menu-icon" data-toggle="tooltip" data-placement="right" data-original-title="Support">more_horiz</i>
                </li>
                <li class=" nav-item"><a href="https://pixinvent.ticksy.com/" target="_blank"><i class="material-icons">local_offer</i><span class="menu-title" data-i18n="Raise Support">Raise Support</span></a>
                </li>
                <li class=" nav-item"><a href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/documentation" target="_blank"><i class="material-icons">format_size</i><span class="menu-title" data-i18n="Documentation">Documentation</span></a>
                </li> --}}
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->
