<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $room->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            @if($room->hasImage('cover'))
                                <img src="{{ $room->image('cover', 'default') }}" alt="{{ $room->title }}" class="w-full rounded-lg shadow-md">
                            @else
                                <div class="w-full aspect-video bg-gray-200 flex items-center justify-center text-gray-400 rounded-lg shadow-md">
                                    {{ __('No Image') }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-4">{{ $room->title }}</h3>
                            <div class="prose max-w-none mb-6">
                                {!! $room->description !!}
                            </div>

                            <hr class="my-6">

                            <!-- Step 5 will add the reservation form here -->
                            <div class="bg-gray-50 p-6 rounded-lg border border-gray-100">
                                <h4 class="text-lg font-semibold mb-4">{{ __('Make a Reservation') }}</h4>
                                @livewire('reservation-form', ['room' => $room])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
