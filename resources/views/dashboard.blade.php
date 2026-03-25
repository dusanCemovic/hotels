<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('dashboard.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($lastReservation)
                        <h3 class="text-lg font-bold mb-4">{{ __('reservations.last-reservation') }}</h3>
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-4 border border-gray-200 dark:border-gray-600">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-semibold text-indigo-600 dark:text-indigo-400">
                                        {{ optional($lastReservation->room)->title ?? ('#'.$lastReservation->room_id) }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $lastReservation->date_from }} - {{ $lastReservation->date_to }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('my-reservations') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                                        {{ __('reservations.view-all') }} &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-6">
                            <p class="text-gray-600 dark:text-gray-400 mb-4">{{ __('reservations.no-reservations') }}</p>
                            <a href="{{ route('rooms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white transition ease-in-out duration-150">
                                {{ __('reservations.start-booking') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
