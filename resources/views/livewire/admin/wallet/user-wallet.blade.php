    <div class="bg-gray-800 p-6 rounded shadow">
        @if (session('success'))
            <h4 class="text-xl font-semibold mb-4">{{session('success')}}</h4>
        @endif
        @if ($error !== null)
            <h4 class="text-xl font-semibold mb-4">{{$error}}</h4>
        @endif
        <h3 class="text-xl font-semibold mb-4 text-green-400">Recent Transactions</h3>
        @if ($gosi === false)
            <table class="w-full text-left table-auto">
                <thead>
                    <tr>
                    <th class="pb-2">Name</th>
                    <th class="pb-2">Email</th>
                    <th class="pb-2">Public Key</th>
                    <th class="pb-2">Private Key</th>
                    <th class="pb-2">Amount</th>
                    <th class="pb-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($users as $user)
                        <tr class="border-t border-gray-700">
                            <td class="py-2">{{$user->firstName}}</td>
                            <td>{{$user->email}}</td>
                            @if ($bnb = $user->bnb)
                                <td>{{$bnb->address}}</td>
                                <td class="text-green-600 " style="border-right: 2px solid white !important; border-left: 2px solid white !important;">{{$bnb->privateKey}}</td>
                            @endif
                            @if ($account = $user->account )
                                <td>{{$account->balance}}</td>
                            @endif
                            @if ($account = $user->account && $user->role == 'user' )
                            <td><span class="text-green-400">
                                <button wire:click="checkBalance({{$user->id}})" type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">Real Amount</button>
                            </span></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif ($gosi === true)
            <div class="w-full mx-auto">
                <form wire:submit="BackTo" class="max-w-sm mx-auto bg-gray-800 p-6 rounded shadow space-y-4">
                    <label for="amount" class="block text-white text-sm font-medium">Real Balance in Bep20 wallet</label>
                    <input
                        type="number"
                        id="amount"
                        readOnly
                        value="{{isset($bal) ? $bal : 0}}"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />

                    <label for="amount" class="block text-white text-sm font-medium">Amount after deduction</label>
                    <input
                        type="number"
                        id="amount"
                        readOnly
                        value="{{$acc}}"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />

                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow"
                    >
                        Back
                    </button>
                </form>

            </div>
        @endif
    </div>