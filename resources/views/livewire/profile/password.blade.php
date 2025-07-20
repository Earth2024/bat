<div class="bg-white p-6 rounded-lg shadow-md">
    @if (session('password'))
        <div class="text-green-600">{{ session('password') }}</div>
    @endif

    @if (session('password_error'))
        <div class="text-red-600">{{ session('password_error') }}</div>
    @endif
    <h2 class="text-xl font-semibold mb-4 text-gray-800">🔐 Update Password</h2>
    <div>
        <div class="relative" style="width: 90% !important; max-width: 240px !important;">
            <input type="password" wire:model="current_password" id="current-password" placeholder="Current Password" class="input-field pr-10" />
            <button type="button" onclick="toggleVisibility('current-password', this)" class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-indigo-600">
                👁️
            </button>
        </div>

        @error('current_password')
            <p class="text-red-600">{{$message}}</p>
        @enderror
    </div>
    <div>
        <div class="relative" style="width: 90% !important; max-width: 240px !important;">
            <input type="password" wire:model="new_password" id="new-password" placeholder="New Password" class="input-field pr-10" />
            <button type="button" onclick="toggleVisibility('new-password', this)" class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-indigo-600">
                👁️
            </button>
        </div>
        @error('new_password')
            <p class="text-red-600">{{$message}}</p>
        @enderror
    </div>
    <div>
        <div class="relative" style="width: 90% !important; max-width: 240px !important;">
            <input type="password" wire:model="new_password_confirmation" id="confirm-password" placeholder="Confirm Password" class="input-field pr-10" />
            <button type="button" onclick="toggleVisibility('confirm-password', this)" class="absolute inset-y-0 right-2 flex items-center text-gray-500 hover:text-indigo-600">
                👁️
            </button>
        </div>
    </div>
    
    <!-- Save Button -->
    <div class="flex justify-start">
        <button wire:click="updatePassword" type="button" class="px-6 py-2 mt-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
        Save Changes
        </button>
    </div>
</div>