<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4 text-gray-800">📞 Contact Details</h2>
    <div class="grid md:grid-cols-2 gap-4">
    <input type="text" wire:model="phone" placeholder="Phone Number" class="input-field" />
    <input type="text" wire:model="address" placeholder="Address Line 1" class="input-field" />
    <input type="text" wire:model="address_2" placeholder="Address Line 2" class="input-field" />
    <input type="text" wire:model="city" placeholder="City" class="input-field" />
    </div>
    <!-- Save Button -->
    <div class="flex justify-center">
        <button type="submit" class="px-6 py-2 mt-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
        Save Changes
        </button>
    </div>
</div>