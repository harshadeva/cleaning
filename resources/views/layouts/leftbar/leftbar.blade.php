<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">

        <!-- Start Logobar -->
        <div class="logobar">
            <a href="{{ route('home') }}" class="logo logo-large"><img
                    src="{{ asset('assets/images/logo-wide.jpg') }}" class="img-fluid" alt="logo"></a>
            <a href="{{ route('home') }}" class="logo logo-small"><img
                    src="{{ asset('assets/images/logo-mobile.jpg') }}" class="img-fluid" alt="logo"></a>
        </div>

        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <ul class="vertical-menu">
                @include('layouts.leftbar.nav-link',['label'=>'Dashboard','route'=>'#'])
                @auth
                    @if (Auth::user()->hasRole('super admin'))
                        @canany(['company_view', 'company_edit', 'company_create', 'company_delete'])
                            @include('layouts.leftbar.dropdown-nav-link',['label'=>'Company',
                            'subroutes'=>[
                            ['permissions'=>['company_create'],'label'=>'Create','route'=>route('admin.company.create')],
                            ['permissions'=>['company_view','company_delete','company_edit'],'label'=>'View','route'=>route('admin.company.index')]
                            ]
                            ])
                        @endcanany
                        @canany(['user_creation_page', 'user_view'])
                            @include('layouts.leftbar.dropdown-nav-link',
                            ['label'=>'User',
                            'subroutes'=>[
                            // ['permissions'=>['user_creation_page'],'label'=>'Create','route'=>route('user.create')],
                            ['permissions'=>['user_view'],'label'=>'View','route'=>route('admin.user.index')]
                            ]
                            ]
                            )
                        @endcanany
                    @else
                        @canany(['user_creation_page', 'user_view'])
                            @include('layouts.leftbar.dropdown-nav-link',
                            ['label'=>'Employee',
                            'subroutes'=>[
                            ['permissions'=>['user_creation_page'],'label'=>'Register','route'=>route('user.create')],
                            ['permissions'=>['user_view'],'label'=>'View','route'=>route('user.index')]
                            ]
                            ]
                            )
                        @endcanany
                        @canany(['site_create', 'site_view', 'site_edit', 'site_delete'])
                            @include('layouts.leftbar.dropdown-nav-link',
                            ['label'=>'Site',
                            'subroutes'=>[
                            ['permissions'=>['site_create'],'label'=>'Register','route'=>route('site.create')],
                            ['permissions'=>['site_view'],'label'=>'View','route'=>route('site.index')]
                            ]
                            ]
                            )
                        @endcanany
                         @canany(['report_create', 'report_view','report_edit','report_create'])
                            @include('layouts.leftbar.dropdown-nav-link',
                            ['label'=>'Report',
                            'subroutes'=>[
                            ['permissions'=>['report_create'],'label'=>'Create','route'=>route('report.create')],
                            ['permissions'=>['report_view'],'label'=>'View','route'=>route('report.index')]
                            ]
                            ]
                            )
                        @endcanany
                    @endif

                    {{-- @include('layouts.leftbar.nav-link',['label'=>'User','route'=>route('user.index')]) --}}
                @endauth





















                @if (1 == 2)

                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/basic.svg') }}" class="img-fluid"
                                alt="basic"><span>Basic
                                UI</span><i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/basic-ui-kits-alerts') }}">Alerts</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-badges') }}">Badges</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-buttons') }}">Buttons</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-cards') }}">Cards</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-carousel') }}">Carousel</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-collapse') }}">Collapse</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-dropdowns') }}">Dropdowns</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-embeds') }}">Embeds</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-grids') }}">Grids</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-images') }}">Images</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-media') }}">Media</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-modals') }}">Modals</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-paginations') }}">Paginations</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-popovers') }}">Popovers</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-progressbars') }}">Progress Bars</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-spinners') }}">Spinners</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-tabs') }}">Tabs</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-toasts') }}">Toasts</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-tooltips') }}">Tooltips</a></li>
                            <li><a href="{{ url('/en/basic-ui-kits-typography') }}">Typography</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/advanced.svg') }}" class="img-fluid"
                                alt="advanced"><span>Advanced UI</span><i
                                class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/advanced-ui-kits-image-crop') }}">Image Crop</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-jquery-confirm') }}">jQuery Confirm</a>
                            </li>
                            <li><a href="{{ url('/en/advanced-ui-kits-nestable') }}">Nestable</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-pnotify') }}">Pnotify</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-range-slider') }}">Range Slider</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-ratings') }}">Ratings</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-session-timeout') }}">Session Timeout</a>
                            </li>
                            <li><a href="{{ url('/en/advanced-ui-kits-sweet-alerts') }}">Sweet Alerts</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-switchery') }}">Switchery</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-toolbar') }}">Toolbar</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-tour') }}">Tour</a></li>
                            <li><a href="{{ url('/en/advanced-ui-kits-treeview') }}">Tree View</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/apps.svg') }}" class="img-fluid"
                                alt="apps"><span>Apps</span><i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/apps-calender') }}">Calender</a></li>
                            <li><a href="{{ url('/en/apps-chat') }}">Chat</a></li>
                            <li>
                                <a href="javaScript:void();">Email<i
                                        class="feather icon-chevron-right pull-right"></i></a>
                                <ul class="vertical-submenu">
                                    <li><a href="{{ url('/en/apps-email-inbox') }}">Inbox</a></li>
                                    <li><a href="{{ url('/en/apps-email-open') }}">Open</a></li>
                                    <li><a href="{{ url('/en/apps-email-compose') }}">Compose</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/en/apps-kanban-board') }}">Kanban Board</a></li>
                            <li><a href="{{ url('/en/apps-onboarding-screens') }}">Onboarding Screens</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/form_elements.svg') }}" class="img-fluid"
                                alt="form_elements"><span>Forms</span><i
                                class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/form-inputs') }}">Basic Elements</a></li>
                            <li><a href="{{ url('/en/form-groups') }}">Groups</a></li>
                            <li><a href="{{ url('/en/form-layouts') }}">Layouts</a></li>
                            <li><a href="{{ url('/en/form-colorpickers') }}">Color Pickers</a></li>
                            <li><a href="{{ url('/en/form-datepickers') }}">Date Pickers</a></li>
                            <li><a href="{{ url('/en/form-editors') }}">Editors</a></li>
                            <li><a href="{{ url('/en/form-file-uploads') }}">File Uploads</a></li>
                            <li><a href="{{ url('/en/form-input-mask') }}">Input Mask</a></li>
                            <li><a href="{{ url('/en/form-maxlength') }}">MaxLength</a></li>
                            <li><a href="{{ url('/en/form-selects') }}">Selects</a></li>
                            <li><a href="{{ url('/en/form-touchspin') }}">Touchspin</a></li>
                            <li><a href="{{ url('/en/form-validations') }}">Validations</a></li>
                            <li><a href="{{ url('/en/form-wizards') }}">Wizards</a></li>
                            <li><a href="{{ url('/en/form-xeditable') }}">X-editable</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/chart.svg') }}" class="img-fluid"
                                alt="chart"><span>Charts</span><i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/chart-apex') }}">Apex</a></li>
                            <li><a href="{{ url('/en/chart-c3') }}">C3</a></li>
                            <li><a href="{{ url('/en/chart-chartistjs') }}">Chartist</a></li>
                            <li><a href="{{ url('/en/chart-chartjs') }}">Chartjs</a></li>
                            <li><a href="{{ url('/en/chart-flot') }}">Flot</a></li>
                            <li><a href="{{ url('/en/chart-knob') }}">Knob</a></li>
                            <li><a href="{{ url('/en/chart-morris') }}">Morris</a></li>
                            <li><a href="{{ url('/en/chart-piety') }}">Piety</a></li>
                            <li><a href="{{ url('/en/chart-sparkline') }}">Sparkline</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/icons.svg') }}" class="img-fluid"
                                alt="icons"><span>Icons</span><i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/icon-svg') }}">SVG</a></li>
                            <li><a href="{{ url('/en/icon-dripicons') }}">Dripicons</a></li>
                            <li><a href="{{ url('/en/icon-feather') }}">Feather</a></li>
                            <li><a href="{{ url('/en/icon-flag') }}">Flag</a></li>
                            <li><a href="{{ url('/en/icon-font-awesome') }}">Font Awesome</a></li>
                            <li><a href="{{ url('/en/icon-ionicons') }}">Ion</a></li>
                            <li><a href="{{ url('/en/icon-line-awesome') }}">Line Awesome</a></li>
                            <li><a href="{{ url('/en/icon-material-design') }}">Material Design</a></li>
                            <li><a href="{{ url('/en/icon-simple-line') }}">Simple Line</a></li>
                            <li><a href="{{ url('/en/icon-socicon') }}">Socicon</a></li>
                            <li><a href="{{ url('/en/icon-themify') }}">Themify</a></li>
                            <li><a href="{{ url('/en/icon-typicons') }}">Typicons</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/tables.svg') }}" class="img-fluid"
                                alt="tables"><span>Tables</span><i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/table-bootstrap') }}">Bootstrap</a></li>
                            <li><a href="{{ url('/en/table-datatable') }}">Datatable</a></li>
                            <li><a href="{{ url('/en/table-editable') }}">Editable</a></li>
                            <li><a href="{{ url('/en/table-footable') }}">Foo</a></li>
                            <li><a href="{{ url('/en/table-rwdtable') }}">RWD</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/maps.svg') }}" class="img-fluid"
                                alt="maps"><span>Maps</span><i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/map-google') }}">Google</a></li>
                            <li><a href="{{ url('/en/map-vector') }}">Vector</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/en/widgets') }}">
                            <img src="{{ asset('assets/images/svg-icon/widgets.svg') }}" class="img-fluid"
                                alt="widgets"><span>Widgets</span><span
                                class="badge badge-success pull-right">New</span>
                        </a>
                    </li>
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/pages.svg') }}" class="img-fluid"
                                alt="pages"><span>Pages</span><i class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li>
                                <a href="javaScript:void();">Basic<i
                                        class="feather icon-chevron-right pull-right"></i></a>
                                <ul class="vertical-submenu">
                                    <li><a href="{{ url('/en/page-starter') }}">Starter</a></li>
                                    <li><a href="{{ url('/en/page-blog') }}">Blog</a></li>
                                    <li><a href="{{ url('/en/page-faq') }}">FAQ</a></li>
                                    <li><a href="{{ url('/en/page-gallery') }}">Gallery</a></li>
                                    <li><a href="{{ url('/en/page-invoice') }}">Invoice</a></li>
                                    <li><a href="{{ url('/en/page-pricing') }}">Pricing</a></li>
                                    <li><a href="{{ url('/en/page-timeline') }}">Timeline</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();">Authentications<i
                                        class="feather icon-chevron-right pull-right"></i></a>
                                <ul class="vertical-submenu">
                                    <li><a href="{{ url('/en/user-login') }}">Login</a></li>
                                    <li><a href="{{ url('/en/user-register') }}">Register</a></li>
                                    <li><a href="{{ url('/en/user-forgotpsw') }}">Forgot Password</a></li>
                                    <li><a href="{{ url('/en/user-lock-screen') }}">Lock Screen</a></li>
                                    <li><a href="{{ url('/en/error-comingsoon') }}">Coming Soon</a></li>
                                    <li><a href="{{ url('/en/error-maintenance') }}">Maintenance</a></li>
                                    <li><a href="{{ url('/en/error-404') }}">Error 404</a></li>
                                    <li><a href="{{ url('/en/error-500') }}">Error 500</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javaScript:void();">
                            <img src="{{ asset('assets/images/svg-icon/ecommerce.svg') }}" class="img-fluid"
                                alt="ecommerce"><span>eCommerce</span><i
                                class="feather icon-chevron-right pull-right"></i>
                        </a>
                        <ul class="vertical-submenu">
                            <li><a href="{{ url('/en/ecommerce-product-list') }}">Product List</a></li>
                            <li><a href="{{ url('/en/ecommerce-product-detail') }}">Product Detail</a></li>
                            <li><a href="{{ url('/en/ecommerce-order-list') }}">Order List</a></li>
                            <li><a href="{{ url('/en/ecommerce-order-detail') }}">Order Detail</a></li>
                            <li><a href="{{ url('/en/ecommerce-shop') }}">Shop</a></li>
                            <li><a href="{{ url('/en/ecommerce-single-product') }}">Single Product</a></li>
                            <li><a href="{{ url('/en/ecommerce-cart') }}">Cart</a></li>
                            <li><a href="{{ url('/en/ecommerce-checkout') }}">Checkout</a></li>
                            <li><a href="{{ url('/en/ecommerce-thankyou') }}">Thank You</a></li>
                            <li><a href="{{ url('/en/ecommerce-myaccount') }}">My Account</a></li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>
