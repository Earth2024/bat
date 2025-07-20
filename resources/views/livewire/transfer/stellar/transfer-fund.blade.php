<div>
    <!-- Trigger Button -->
    <button wire:click="$set('showModal', true)" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700">
        Send USDT BEP20
    </button>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60">
            <div class="bg-white w-full max-w-md rounded-lg shadow-xl p-6 space-y-4">
                <h2 class="text-xl font-semibold text-gray-800">Transfer USDT BEP20</h2>

                @if ($success)
                    <div class="text-green-600">{{ $success }}</div>
                @endif

                @if ($error)
                    <div class="text-red-600">{{ $error }}</div>
                @endif

                @if (session()->has('message'))
                    <div>{{ session('message') }}</div>
                @endif

                @if (session()->has('error'))
                    <div style="color: red">{{ session('error') }}</div>
                @endif

                <div>
                    <label class="block text-sm font-medium text-gray-700">Recipient Wallet (Only USDT BEP20 )</label>
                    <input style="border: 1px solid black;" type="text" wire:model.defer="address" class="mt-1 block w-full  rounded-md border-black-300 shadow-sm focus:ring" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount (USDT)</label>
                    <input style="border: 1px solid black;" type="number" wire:model.live="amount" step="0.000001" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring" />
                    @error('amount') 
                        <div>
                            <span class="text-sm text-red-500">{{$message}}</span>
                        </div>
                     @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pin (4 Digits)</label>
                    <input style="border: 1px solid black;" type="text" wire:model.live="pin" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring" />
                    @error('pin') 
                        <div>
                            <span class="text-sm text-red-500">{{$message}}</span>
                        </div>
                     @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button wire:click="sendTransfer" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Transfer</button>
                    <button wire:click="$set('showModal', false)" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>
                </div>
            </div>
        </div>
    @endif
</div>
