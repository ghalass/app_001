<div class="form-floating mb-1">
    <select class="form-select @error("{{ $name }}") is-invalid @enderror" name="{{ $name }}">
        <option selected value="">{{ $label }} ----</option>
        @foreach ($items as $item)
            <option value="{{ $item->id }}"
                {{ old($name) == $item->id || $item->id == $defaultValue ? 'selected' : '' }}>
                {{ $item->name }}
            </option>
        @endforeach
    </select>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @error($name)
        <p class="text-danger fst-italic fw-lighter">{{ $message }}</p>
    @enderror
</div>
