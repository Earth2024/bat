<div class="bg-white p-6 rounded-lg shadow-md">
    @if (session('pin'))
        <div class="text-green-600">{{ session('pin') }}</div>
    @endif

    @if (session('pin_error'))
        <div class="text-red-600">{{ session('pin_error') }}</div>
    @endif
    <h2 class="text-xl font-semibold mb-4 text-gray-800">🔐 Update Pin</h2>
    <div>
        <div class="relative" style="width: 90% !important; max-width: 240px !important;">
            <input type="password" wire:model="current_pin" id="current-pin" placeholder="Current Pin" class="input-field pr-10" />
            <button type="button" onclick="toggleVisibility('current-pin', this)" class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-indigo-600">
                👁️
            </button>
        </div>

        @error('current_pin')
            <p class="text-red-600">{{$message}}</p>
        @enderror
    </div>
    <div>
        <div class="relative" style="width: 90% !important; max-width: 240px !important;">
            <input type="password" wire:model="new_pin" id="new-pin" placeholder="New Pin" class="input-field pr-10" />
            <button type="button" onclick="toggleVisibility('new-pin', this)" class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-indigo-600">
                👁️
            </button>
        </div>
        @error('new_pin')
            <p class="text-red-600">{{$message}}</p>
        @enderror
    </div>
    <div>
        <div class="relative" style="width: 90% !important; max-width: 240px !important;">
            <input type="password" wire:model="new_pin_confirmation" id="confirm-pin" placeholder="Confirm Pin" class="input-field pr-10" />
            <button type="button" onclick="toggleVisibility('confirm-pin', this)" class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-indigo-600">
                👁️
            </button>
        </div>
    </div>
    
    <!-- Save Button -->
    <div class="flex justify-start">
        <button wire:click="updatePin" type="button" class="px-6 py-2 mt-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
        Save Changes
        </button>
    </div>
</div>