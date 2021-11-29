<li>
    <a href="javaScript:void();">
        <img src="{{ $icon }}" class="img-fluid"
            alt="link image"><span>{{ $label }}</span><i class="feather icon-chevron-right pull-right"></i>
    </a>
    <ul class="vertical-submenu">
        @foreach ($subroutes as $subroute)
            @canany($subroute['permissions'])
                <li><a href="{{ $subroute['route'] }}">{{ $subroute['label'] }}</a></li>
            @endcanany
        @endforeach
    </ul>
</li>
