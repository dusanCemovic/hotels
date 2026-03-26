<x-app-layout>
    <x-slot name="header">
        {{ __('navigation.my-reservations') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($reservations->isEmpty())
                        <div class="text-gray-500">{{ __('reservations.no-reservations') }}</div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('reservations.room') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('reservations.from') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('reservations.to') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('reservations.name') }}</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('reservations.email') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('rooms.show', $reservation->room_id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    {{ optional($reservation->room)->title ?? ('#'.$reservation->room_id) }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->date_from }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->date_to }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
