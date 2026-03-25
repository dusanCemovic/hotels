<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center text-xl font-bold text-gray-800 dark:text-gray-200 uppercase tracking-widest">
            {{ config('app.name', 'Hotel') }}
        </div>

        <div class="flex flex-col space-y-4">
            <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="w-full inline-flex justify-center items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('Register') }}
                </a>
            @endif
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 dark:border-gray-700">
            <div class="flex justify-center space-x-6">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" 
                       class="text-sm font-medium {{ app()->getLocale() == $localeCode ? 'text-indigo-600 underline' : 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200' }}">
                        {{ strtoupper($localeCode) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
