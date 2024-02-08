@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-white bg-green-600 px-3 py-2']) }}>
        {{ $status }}
    </div>
@endif
