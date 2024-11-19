<?php
if (!isset($page)) {
    $page = 'typeparcs';
}

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
];
?>

<div class="">
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
</div>
