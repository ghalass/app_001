<div class="form-floating mb-1">
    <input type="text" class="form-control @error("{{ $name }}") is-invalid @enderror"
        name="{{ $name }}" id="floating{{ ucfirst($name) }}" placeholder=""
        value={{ old("$name", $defaultValue) }}>
    <label for="floating{{ ucfirst($name) }}">{{ $label }}</label>
    @error($name)
        <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
    @enderror
</div>
