<a href="{{ route($link) }}" class="btn btn-outline-primary position-relative">
    <i class="{{ $icon }}"></i> {{ $title }}
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
        {{ $total }}
    </span>
</a>
