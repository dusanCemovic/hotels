<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('rooms.rooms-list') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($rooms as $room)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if($room->hasImage('cover'))
                            <img src="{{ $room->image('cover', 'default') }}" alt="{{ $room->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                {{ __('rooms.no-image') }}
                            </div>
                        @endif
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-bold">{{ $room->title }}</h3>
                            <div class="mt-2 text-gray-600">
                                {!! Str::limit(strip_tags($room->description), 100) !!}
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('rooms.show', $room->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('rooms.view-details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($rooms->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    {{ __('rooms.no-rooms') }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
