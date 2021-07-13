<li>
    <a href="javaScript:void();">
        <img src="{{ asset('assets/images/svg-icon/dashboard.svg') }}" class="img-fluid"
            alt="dashboard"><span>{{ $label }}</span><i class="feather icon-chevron-right pull-right"></i>
    </a>
    <ul class="vertical-submenu">
        @foreach ($subroutes as $subroute)
            @canany($subroute['permissions'])
                <li><a href="{{ $subroute['route'] }}">{{ $subroute['label'] }}</a></li>
            @endcanany
        @endforeach
    </ul>
</li>
