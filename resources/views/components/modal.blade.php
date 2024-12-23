<!-- Modal -->
@props(['modelTitle', 'eventName', 'testName'])
<div class="modal fade" id="{{ $eventName }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $modelTitle }}</h1>
                <button @click="$dispatch('{{ $eventName }}-close')" type="button" type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
                <div>
                    {{ $testName }}
                </div>
            </div>
            <div class="modal-footer">
                <button @click="$dispatch('{{ $eventName }}-close')" type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button @click="$dispatch('{{ $eventName }}')" type="button" type="button"
                    class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
