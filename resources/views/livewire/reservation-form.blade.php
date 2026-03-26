<div>
    @if($isSuccess)
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            <span class="font-medium">{{ __('rooms.reservation-form.success') }}</span>
            <a href="{{ route('my-reservations') }}" class="underline">{{ __('navigation.my-reservations') }}</a>
        </div>
    @else
        <form wire:submit.prevent="submit">
            @if($step === 1)
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('rooms.reservation-form.step1') }}</h3>
                    <div>
                        <x-input.input-label for="date_from" :value="__('rooms.reservation-form.date-from')" class="dark:text-gray-700" />
                        <x-input.input-text id="date_from" class="block mt-1 w-full" type="date" wire:model="date_from" required />
                        <x-input.input-error :messages="$errors->get('date_from')" class="mt-2" />
                    </div>
                    <div>
                        <x-input.input-label for="date_to" :value="__('rooms.reservation-form.date-to')" class="dark:text-gray-700" />
                        <x-input.input-text id="date_to" class="block mt-1 w-full" type="date" wire:model="date_to" required />
                        <x-input.input-error :messages="$errors->get('date_to')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-3">
                            {{ __('rooms.reservation-form.next') }}
                        </x-primary-button>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('rooms.reservation-form.step2') }}</h3>
                    <div>
                        <x-input.input-label for="name" :value="__('rooms.reservation-form.name')" />
                        <x-input.input-text id="name" class="block mt-1 w-full" type="text" wire:model="name" required />
                        <x-input.input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input.input-label for="email" :value="__('rooms.reservation-form.email')" />
                        <x-input.input-text id="email" class="block mt-1 w-full" type="email" wire:model="email" required />
                        <x-input.input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <button type="button" wire:click="$set('step', 1)" class="text-sm text-gray-600 hover:text-gray-900 underline">
                            {{ __('rooms.reservation-form.cancel') }}
                        </button>
                        <x-primary-button class="ms-3">
                            {{ __('rooms.reservation-form.submit') }}
                        </x-primary-button>
                    </div>
                </div>
            @endif
        </form>
    @endif
</div>
