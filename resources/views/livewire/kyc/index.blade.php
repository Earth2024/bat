<div class="max-w-6xl mx-auto p-4 space-y-6 text-sm text-gray-800 dark:text-gray-100">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">KYC Dashboard</h2>
            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">KYC Verified</span>
        </div>

        @if ($showIndex === true)
        <!-- KYC Document Status -->
        <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
            <h3 class="font-semibold mb-2">KYC Documents</h3>
            @if (session('id_success'))
                <div class="text-green-600 text-sm">{{ session('id_success') }}</div>
            @endif
            <ul class="space-y-2">
            <li class="flex justify-between items-center">
                <span>Identification</span>
                <span class="text-green-600 text-xs">
                    <button wire:click="showIdForm" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md text-base font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300">
                    Proceed
                    </button>
                </span>
            </li>
            <li class="flex justify-between items-center">
                <span>Utility Bill</span>
                <span class="text-yellow-600 text-xs">
                    <button wire:click="showUtilityForm" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md text-base font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300">
                    Proceed
                    </button>
                </span>
            </li>
            <li class="flex justify-between items-center">
                <span>Selfie Verification</span>
                <span class="text-red-600 text-xs">
                    <button wire:click="showSelfieForm" class="w-full sm:w-auto px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md text-base font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300">
                    Proceed
                    </button>
                </span>
            </li>
            </ul>
        </div>
        @endif

        @if ($showId === true)
        <!-- id verification -->
        <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6 space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 text-center">Verify Your Identity</h2>
            
            <form wire:submit.prevent="storeIdentity" enctype="multipart/form-data" class="space-y-4">

                <!-- Phone Number -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input wire:model="phone" type="tel" placeholder="+1..." class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Address Line 1 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address Line 1</label>
                    <textarea wire:model="address_1" rows="2" placeholder="123 Example Street" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    @error('address_1') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Address Line 2 -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Address Line 2 (Optional)</label>
                    <textarea wire:model="address_2" rows="2" placeholder="Apartment, suite, etc." class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    @error('address_2') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- City -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <input wire:model="city" type="text" placeholder="Abuja" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('city') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- State -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">State/County</label>
                    <input wire:model="state" type="text" placeholder="FCT" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('state') <span class="text-red-600 text-sm">State/County is required</span> @enderror
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Country</label>
                    <input wire:model="country" type="text" placeholder="Country" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('country') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Postal Code -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Postal Code</label>
                    <input wire:model="postal_code" type="text" placeholder="100000" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('postal_code') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">ID Type</label>
                    <select wire:model="id_type" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Select ID Type</option>
                        <option value="national id">National ID</option>
                        <option value="driver license">Driver's License</option>
                        <option value="passport">Passport</option>
                    </select>
                    @error('id_type') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-gray-700">ID Number</label>
                    <input wire:model="id_number" type="text" placeholder="ID Number" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('id_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    @if ($id_img)
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Preview:</p>
                            <img src="{{ $id_img->temporaryUrl() }}" class="w-full max-w-xs rounded-lg border shadow" style="max-height: 170px;" />
                        </div>
                    @endif
                    <label class="block text-sm font-medium text-gray-700">Upload ID Document</label>
                    <input wire:model.live="id_img" type="file" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    @error('id_img') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 mt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">Submit</button>
                    <button wire:click="backTo" type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">Back</button>
                </div>
            </form>
        </div>
        @endif

        @if ($showUtility === true)
        <!-- utility bill verification -->
        <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6 space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 text-center">Verify Your Identity</h2>
            
            <form wire:submit.prevent="storeUtility" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Utility Bill Type</label>
                <select wire:model="utility_type" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Utility Bill Type</option>
                    <option value="electricity bill">Electricity Bill</option>
                    <option value="water bill">Water Bill</option>
                    <option value="internet bill">Internet and Telephone Bill</option>
                    <option value="waste bill">Waste Bill</option>
                    <option value="tv bill">TV Bill</option>
                    <option value="security levy">Security Levy</option>
                </select>
            </div>
            
            <div>
                    @if ($utility_img)
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Preview:</p>
                            <img src="{{ $utility_img->temporaryUrl() }}" class="w-full max-w-xs rounded-lg border shadow" style="max-height: 170px;" />
                        </div>
                    @endif
                <label class="block text-sm font-medium text-gray-700">Upload Utility Bill</label>
                <input wire:model.live="utility_img" type="file" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            
                <div class="flex flex-wrap justify-between gap-1 mt-4" style="display:flex;">
                    <button type="submit"
                        class="flex-1 min-w-[120px] bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">
                        Submit
                    </button>

                    <button wire:click="backTo" type="button"
                        class="flex-1 min-w-[120px] bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">
                        Back
                    </button>
                </div>

            </form>
        </div>
        @endif

        @if ($showSelfie === true)
        <!-- take a selfie -->
        <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6 space-y-6">
            <h2 class="text-2xl font-bold text-gray-800 text-center">Selfie Verification</h2>
            
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Take Selfie</label>
                    <input type="file" class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 mt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">Submit</button>
                    <button wire:click="backTo" type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">Back</button>
                </div>
        </div>
        @endif

    </div>