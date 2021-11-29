<li>
    <a href="{{ $route }}">
        @if (isset($iconClass))
        <i class="{{ $iconClass }} text-muted"></i><span>{{ $label }}</span>
        @elseif(isset($icon))
        <img src="{{ $icon }}" class="img-fluid"
        alt="link image"/><span>{{ $label }}</span>
        @endif
    </a>
</li>
