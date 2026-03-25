<div>
    @if($isSuccess)
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            <span class="font-medium">{{ __('Uspešna rezervacija') }}</span>
        </div>
    @else
        <form wire:submit.prevent="{{ $step === 1 ? 'nextStep' : 'submit' }}">
            @if($step === 1)
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Step 1: Select Dates') }}</h3>
                    <div>
                        <x-input-label for="date_from" :value="__('Date From')" />
                        <x-text-input id="date_from" class="block mt-1 w-full" type="date" wire:model="date_from" required />
                        <x-input-error :messages="$errors->get('date_from')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="date_to" :value="__('Date To')" />
                        <x-text-input id="date_to" class="block mt-1 w-full" type="date" wire:model="date_to" required />
                        <x-input-error :messages="$errors->get('date_to')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-3">
                            {{ __('Next') }}
                        </x-primary-button>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('Step 2: Personal Information') }}</h3>
                    <p class="text-sm text-gray-600">
                        {{ __('Booking for:') }} {{ $date_from }} - {{ $date_to }}
                    </p>
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" wire:model="name" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" wire:model="email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <button type="button" wire:click="$set('step', 1)" class="text-sm text-gray-600 hover:text-gray-900 underline">
                            {{ __('Back') }}
                        </button>
                        <x-primary-button class="ms-3">
                            {{ __('Book Now') }}
                        </x-primary-button>
                    </div>
                </div>
            @endif
        </form>
    @endif
</div>
