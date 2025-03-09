@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-900 mb-1']) }}>
    {{ $value ?? $slot }}
    @if ($required)
        <span>*</span>
    @endif
</label>
