    <div class="bg-gray-800 p-6 rounded shadow">
        @if (session('success'))
            <h4 class="text-xl font-semibold mb-4">{{session('success')}}</h4>
        @endif
        <h3 class="text-xl font-semibold mb-4 text-green-400">Recent Transactions</h3>
        @if ($gosi === false)
            <table class="w-full text-left table-auto">
                <thead>
                    <tr>
                    <th class="pb-2">Name</th>
                    <th class="pb-2">Email</th>
                    <th class="pb-2">Amount</th>
                    <th class="pb-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-t border-gray-700">
                            <td class="py-2">{{$user->firstName}}</td>
                            <td>{{$user->email}}</td>
                            @if ($account = $user->account)
                                <td>{{$account->balance}}</td>
                                @else
                                <td><span class="text-green-400">0.00</span></td>
                            @endif
                            @if ($account = $user->account)
                            <td><span class="text-green-400">
                                <button wire:click="showForm({{$account->balance}}, {{$account->id}})" type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">Add fund</button>
                            </span></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif ($gosi === true)
            <div class="w-full mx-auto">
                <form wire:submit="addFund" class="max-w-sm mx-auto bg-gray-800 p-6 rounded shadow space-y-4">
                    <label for="amount" class="block text-white text-sm font-medium">Enter Amount</label>
                    <input
                        type="number"
                        id="amount"
                        wire:model="amount"
                        placeholder="e.g. 100"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    @error('amount')
                        <label for="amount" class="block text-white text-sm font-medium">Please Enter Amount</label>
                    @enderror

                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow"
                    >
                        Fund
                    </button>
                </form>

            </div>
        @endif
    </div>