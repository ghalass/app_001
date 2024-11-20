<div class="form-floating mb-1">
    <textarea name="{{ $name }}" id="{{ $name }}" style="height: 100px" placeholder=""
        class="form-control @error('{{ $name }}') is-invalid @enderror">{{ old("$name", $defaultValue) }}</textarea>
    <label for="{{ $name }}">{{ $label }}</label>
    @error(' {{ $name }}')
        <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
    @enderror
</div>
