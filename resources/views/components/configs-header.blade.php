<?php

$items = [
    (object) [
        'title' => 'Configs',
        'link' => 'configs',
        'active' => $page == 'configs' ? ' active' : '',
        'icon' => 'bi bi-gear',
    ],
    (object) [
        'title' => 'Sites',
        'link' => 'sites.index',
        'active' => $page == 'sites' ? ' active' : '',
        'icon' => 'bi bi-geo-alt-fill',
    ],
    (object) [
        'title' => 'Types parcs',
        'link' => 'typeparcs.index',
        'active' => $page == 'typeparcs' ? ' active' : '',
        'icon' => 'bi bi-diagram-3',
    ],
    (object) [
        'title' => 'Parcs',
        'link' => 'parcs.index',
        'active' => $page == 'parcs' ? ' active' : '',
        'icon' => 'bi bi-truck',
    ],
    (object) [
        'title' => 'Engins',
        'link' => 'engins.index',
        'active' => $page == 'engins' ? ' active' : '',
        'icon' => 'bi bi-truck-flatbed',
    ],
    (object) [
        'title' => 'Types lubrifiants',
        'link' => 'typelubrifiants.index',
        'active' => $page == 'typelubrifiants' ? ' active' : '',
        'icon' => 'bi bi-droplet-fill',
    ],
    (object) [
        'title' => 'Lubrifiants',
        'link' => 'lubrifiants.index',
        'active' => $page == 'lubrifiants' ? ' active' : '',
        'icon' => 'bi bi-droplet-half',
    ],
    (object) [
        'title' => 'Types organes',
        'link' => 'typeorganes.index',
        'active' => $page == 'typeorganes' ? ' active' : '',
        'icon' => 'bi bi-diagram-3',
    ],
    (object) [
        'title' => 'Organes',
        'link' => 'organes.index',
        'active' => $page == 'organes' ? ' active' : '',
        'icon' => 'bi bi-truck',
    ],
];
?>

{{-- <div class="">
    <ul class="nav nav-tabs justify-content-center">
        @foreach ($items as $item)
            <li class="nav-item">
                <a class="nav-link {{ $item->active }}" href={{ route($item->link) }}>
                    <i class="{{ $item->icon }}"></i>
                    {{ $item->title }}
                </a>
            </li>
        @endforeach
    </ul>
</div> --}}

<ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
    @foreach ($items as $item)
        <li class="w-100">
            <a href="{{ route($item->link) }}" wire: class="nav-link px-0">
                <span class="d-none d-sm-inline">
                    <i class="{{ $item->icon }}"></i>
                    {{ $item->title }}
                </span>
            </a>
        </li>
    @endforeach
</ul>
