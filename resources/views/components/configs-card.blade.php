<div {{ $attributes }}>
    <div class="card" style="width: 250px; height: 160px;">
        <div class="card-body">
            <div class="float-end">
                <a class="btn btn-sm btn-outline-info" href={{ route($page . 's.show', [$page => $item]) }}>
                    <i class="bi bi-eye-fill"></i>
                </a>
                <a class="btn btn-sm btn-outline-success" href={{ route($page . 's.edit', [$page => $item]) }}>
                    <i class="bi bi-pen"></i>
                </a>

                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                    data-bs-target="{{ '#exampleModal' . $item->id }}">
                    <i class="bi bi-trash3"></i>
                </button>
            </div>

            <h5 class="card-title">
                {{ substr($item->name, 0, 10) }}
            </h5>
            <p class="card-text">
                @if (Str::length($item->description) > 40)
                    {{ substr($item->description, 0, 40) . ' .....' }}
                @else
                    {{ $item->description }}
                @endif
            </p>

            <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                Crée le : {{ $item->created_at->format('d-m-Y à H:i') }}
            </h6>
            <h6 class="card-subtitle mb-2 text-body-secondary float-end">
                Modifié le : {{ $item->updated_at->format('d-m-Y à H:i') }}
            </h6>

        </div>
    </div>
</div>

<x-forms.modal-delete :$item model='{{ $page }}' />
