<div class="topbar">
    <!-- Start row -->
    <div class="row align-items-center">
        <!-- Start col -->
        <div class="col-md-12 align-self-center">
            <div class="togglebar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="menubar">
                            <a class="menu-hamburger" href="javascript:void();">
                                <img src="{{ asset('assets/images/svg-icon/collapse.svg') }}"
                                    class="img-fluid menu-hamburger-collapse" alt="collapse">
                                <img src="{{ asset('assets/images/svg-icon/close.svg') }}"
                                    class="img-fluid menu-hamburger-close" alt="close">
                            </a>
                            <h4 style="display:inline">@yield('title')</h4>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="infobar">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <div class="profilebar">
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="profilelink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                        src="{{ asset('assets/images/users/avatar.png') }}" class="img-fluid"
                                        alt="profile"><span class="feather icon-chevron-down live-icon"></span></a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                    <div class="dropdown-item">
                                        <div class="profilename d-flex align-items-start">
                                            <h4>{{ Auth::user()->name }}</h4>
                                        </div>
                                    </div>
                                    <div class="userbox">
                                        <ul class="list-unstyled mb-0">
                                            <li class="media dropdown-item">
                                                <a href="#" class="profile-icon"><img
                                                        src="{{ asset('assets/images/svg-icon/user.svg') }}"
                                                        class="img-fluid" alt="user">My Profile</a>
                                            </li>
                                            <li class="media dropdown-item">
                                                <a href="#" class="profile-icon"><img
                                                        src="{{ asset('assets/images/svg-icon/email.svg') }}"
                                                        class="img-fluid" alt="email">Email</a>
                                            </li>
                                            <li class="media dropdown-item">
                                                <form id="logout_form" method="POST" action="{{ route('logout') }}">
                                                    {{ csrf_field() }}
                                                    <button form="logout_form" class="btn btn-primary" type="submit" value="logout" >Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->
</div>
