<?php
$Performances = [(object) ['title' => 'Saisie RJE', 'url' => 'performances/rje_saisie', 'icon' => 'far fa-keyboard'], (object) ['title' => 'Rapport RJE', 'url' => 'performances/rje_rapport', 'icon' => 'far fa-file-alt'], (object) ['title' => 'Rapport Unités physique', 'url' => 'performances/rapport_unitephysique', 'icon' => 'far fa-file-alt'], (object) ['title' => 'Rapport Etat Mensuel', 'url' => 'performances/rapport_etatmensuel', 'icon' => 'far fa-file-alt'], (object) ['title' => "Analyse d'indisponibilité", 'url' => 'performances/analyseindisponibilite', 'icon' => 'far fa-file-alt'], (object) ['title' => 'Etat Général', 'url' => 'performances/etatgeneral', 'icon' => 'far fa-file-alt']];
$Lubrifiants = [(object) ['title' => 'Saisie', 'url' => 'lubrifiants/saisie', 'icon' => 'far fa-keyboard'], (object) ['title' => 'Calcul du Spécifique', 'url' => 'lubrifiants/specifiques', 'icon' => 'fas fa-tint']];
$SuiviOrganes = [(object) ['title' => "Types d'organes", 'url' => 'typeorganes', 'icon' => 'fas fa-tag'], (object) ['title' => 'Organes', 'url' => 'organes', 'icon' => 'fas fa-puzzle-piece'], (object) ['title' => 'Mouvement organes', 'url' => 'mouvementorganes', 'icon' => 'fas fa-sync'], (object) ['title' => 'Fiche vie organes', 'url' => 'fichevieorganes', 'icon' => 'fas fa-folder-open']];
$Configurations = [(object) ['title' => 'Sites', 'url' => 'configs/sites', 'icon' => 'fas fa-map-marker-alt'], (object) ['title' => 'Types de parcs', 'url' => 'configs/typeparcs', 'icon' => 'fas fa-truck-moving'], (object) ['title' => 'Parcs', 'url' => 'configs/parcs', 'icon' => 'fas fa-truck-pickup'], (object) ['title' => 'Engins', 'url' => 'configs/engins', 'icon' => 'fas fa-truck-monster'], (object) ['title' => 'Types des lubrifiants', 'url' => 'configs/typelubrifiants', 'icon' => 'fas fa-fill-drip'], (object) ['title' => 'Lubrifiants', 'url' => 'configs/lubrifiants', 'icon' => 'fas fa-tint'], (object) ['title' => 'Objectifs Lubrifiants', 'url' => 'configs/objectiflubrifiants', 'icon' => 'fas fa-bullseye'], (object) ['title' => 'Types des pannes', 'url' => 'configs/typepannes', 'icon' => 'far fa-keyboard'], (object) ['title' => 'Pannes', 'url' => 'configs/pannes', 'icon' => 'far fa-keyboard'], (object) ['title' => 'Utilisateurs', 'url' => 'configs/users', 'icon' => 'fas fa-users']];
?>

<aside class="main-sidebar sidebar-light-lightblue ">
    <!-- Brand Logo -->
    <a wire:navigate href="/" class="brand-link">
        <img src="{{ asset('images/snim.png') }}" alt="snim Logo" class="brand-image  " style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Laravel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image ">
                <img src="{{ asset('images/user2-160x160.png') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="info">
                <a wire:navigate href="/" class="d-block">Bienvenue</a>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a wire:navigate href="/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Performances -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-chart-bar"></i>
                        <p>
                            Performances Engins
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($Performances as $item) : ?>
                        <li class="nav-item">
                            <a wire:navigate href="<?= '/' . $item->url ?>" class="nav-link">
                                <i class="nav-icon <?= $item->icon ?>"></i>
                                <p><?= $item->title ?></p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Lubrifiants -->
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-oil-can"></i>
                        <p>
                            Lubrifiants
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($Lubrifiants as $item) : ?>
                        <li class="nav-item">
                            <a href="<?= '/' . $item->url ?>" class="nav-link ">
                                <i class="nav-icon <?= $item->icon ?>"></i>
                                <p><?= $item->title ?></p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Suivi organes -->
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Suivi des organes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($SuiviOrganes as $item) : ?>
                        <li class="nav-item">
                            <a wire:navigate href="<?= '/' . $item->url ?>" class="nav-link ">
                                <i class="nav-icon <?= $item->icon ?>"></i>
                                <p><?= $item->title ?></p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

                <!-- Configurations -->
                <li class="nav-item">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Configurations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($Configurations as $item) : ?>
                        <li class="nav-item">
                            <a wire:navigate href="<?= '/' . $item->url ?>" class="nav-link">
                                <i class="nav-icon <?= $item->icon ?>"></i>
                                <p><?= $item->title ?></p>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
