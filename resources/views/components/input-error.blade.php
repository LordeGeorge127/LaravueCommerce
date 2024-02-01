@props(['messages'])
{{--'text-sm text-white space-y-1 bg-red-600 px-4 py-3 text-center'--}}
{{--mt-3 list-disc list-inside text-sm text-red-600--}}
@if ($messages)
    <div {{ $attributes->merge([ 'class' => 'bg-red-600 rounded px-4 py-3 text-white ']) }}>

        <div class="font-medium ">
            {{ __('Whoops! Something Went wrong.') }}
        </div>
        <ul class="mt-3 text-sm ">
            @foreach ((array) $messages as $message)
                {{--            <li>Wrong Email or Password </li>--}}
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif

