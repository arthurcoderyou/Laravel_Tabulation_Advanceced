@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-dark my-0 mt-3']) }}>
    {{ $value ?? $slot }}
</label>
