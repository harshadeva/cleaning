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
                        @canany(['report_create', 'report_view', 'report_edit', 'report_create'])
                            @include('layouts.leftbar.dropdown-nav-link',
                            ['label'=>'Report',
                            'subroutes'=>[
                            ['permissions'=>['report_create'],'label'=>'Create','route'=>route('report.create')],
                            ['permissions'=>['report_view'],'label'=>'View','route'=>route('report.index')]
                            ]
                            ]
                            )
                        @endcanany
                         @canany(['setting_view', 'setting_edit'])
                                @include('layouts.leftbar.nav-link',['permissions'=>['setting_view','setting_edit'],'label'=>'Settings','route'=>route('settings.index')])
                        @endcanany
                    @endif

                    {{-- @include('layouts.leftbar.nav-link',['label'=>'User','route'=>route('user.index')]) --}}
                @endauth

            </ul>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>
