<x-app-layout>
    <form
        action="{{ route('register') }}"
        method="post"
        class="w-[400px] mx-auto p-6 my-16"
    >
        @csrf
        <h2 class="text-2xl font-semibold text-center mb-4">Create an account</h2>
        <p class="text-center text-gray-500 mb-3">
            or
            <a
                href="{{ route('login') }}"
                class="text-sm text-purple-700 hover:text-purple-600"
            >login with existing account</a
            >
        </p>
        <div class="mb-4">
            <x-text-input
                placeholder="Your name"
                type="text"
                name="name"
                :value="old('name')"
                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full"

            />
            {{--            @error('name')--}}
            {{--            <span class="invalid-feedback" role="alert">--}}
            {{--                <strong>{{!!$message }}</strong>--}}
            {{--            </span>--}}
            {{--            @enderror--}}
        </div>
        </p>
        <div class="mb-4">
            <x-text-input
                placeholder="Your Email"
                type="email"
                name="email"
                :value="old('email')"
                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full"


            />
            {{--            @error('email')--}}
            {{--            <span class="invalid-feedback" role="alert">--}}
            {{--                <strong>{{!!$message }}</strong>--}}
            {{--            </span>--}}
            {{--            @enderror--}}
        </div>
        <div class="mb-4">
            <x-text-input
                placeholder="Password"
                type="password"
                name="password"
                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full"


            />
        </div>
        <div class="mb-4">
            <x-text-input
                placeholder="Repeat Password"
                type="password"
                name="password_confirmation"
                class="border-gray-300 focus:border-purple-500 focus:outline-none focus:ring-purple-500 rounded-md w-full"


            />
        </div>

        <x-primary-button
            class="btn-primary bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 w-full"
        >
            Signup
        </x-primary-button>
    </form>
</x-app-layout>
