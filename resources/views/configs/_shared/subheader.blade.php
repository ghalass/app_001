<h1 class="text-center">Liste des {{ $page }}</h1>
<div class="d-flex align-items-center justify-content-center gap-1">
    <div class="">
        <a class=" btn btn-sm btn-outline-success " href={{ route($page . '.create') }}>
            <i class="bi bi-plus-lg"></i>
            Nouveau
        </a>
    </div>

    <div>
        <form action="{{ route($page . '.index') }}" method="GET" class="d-flex  mb-0" role="search">
            <div class="d-flex align-items-center gap-1">
                <input class="form-control form-control-sm" type="search" placeholder="Chercher..." aria-label="Search"
                    name="search" value="{{ $search }}">
                <button class="btn btn-sm btn-outline-info" type="submit">Chercher</button>

                @if ($search !== '')
                    <a class="btn btn-sm btn-outline-secondary " href={{ route($page . '.index') }}>
                        Annuler
                    </a>
                @endif

            </div>
        </form>
    </div>
</div>
