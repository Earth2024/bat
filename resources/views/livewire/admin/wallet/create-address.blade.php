    <div class="bg-gray-800 p-6 rounded shadow">
        @if (session('success'))
            <h4 class="text-xl font-semibold mb-4">{{session('success')}}</h4>
        @endif
        <h3 class="text-xl font-semibold mb-4 text-green-400">Wallets</h3>
            <div class="w-full mx-auto">
                <form wire:submit="createWallet" class="max-w-sm mx-auto bg-gray-800 p-6 rounded shadow space-y-4">
                    <label for="amount" class="block text-white text-sm font-medium">Create Wallet</label>
                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow"
                    >
                        Create Wallet
                    </button>
                </form>
            </div>
            <div class="overflow-x-auto w-full">
                <table class="min-w-full text-left table-auto">
                    <thead>
                        <tr>
                            <th class="pb-2">#</th>
                            <th class="pb-2">Wallet</th>
                            <th class="pb-2">Private</th>
                            <th class="pb-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($wallets)
                            @foreach ($wallets as $key => $wallet)
                                <tr class="border-t border-gray-700">
                                    <td class="py-2">{{$key + 1}}</td>
                                    <td>{{$wallet->public_key}}</td>
                                    <td style="color: green; border-left: 1px solid white;">{{$wallet->secret_key}}</td>
                                    <td><strong>Funded:</strong> {{ $wallet->funded ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <span class="text-green-400">
                                            <button wire:click="showForm" type="button"
                                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                                                Delete
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

    </div>