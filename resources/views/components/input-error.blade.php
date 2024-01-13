@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-white space-y-1 bg-red-600 px-4 py-3 text-center']) }}>
        @foreach ((array) $messages as $message)
{{--            <li>Wrong Email or Password </li>--}}
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
