@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-white bg-green-500 px-3 py-2']) }}>
        {{ $status }}
    </div>
@endif
