    <div class="bg-gray-800 p-6 rounded shadow">
        @if (session('success'))
            <h4 class="text-xl font-semibold mb-4">{{session('success')}}</h4>
        @endif
        @if ($error !== null)
            <h4 class="text-xl font-semibold mb-4">{{$error}}</h4>
        @endif
        <div class="flex justify-between">
            <h4 class="text-xl font-semibold mb-4 text-green-400">Users</h4>
            <h4 class="text-xl font-semibold mb-4 text-blue-400 cursor-pointer bg-blue-500 text-white px-4 py-2 rounded" wire:click="createUserForm">Create User</h4>
        </div>
        @if ($showUser === true)
            <table class="w-full text-left table-auto">
                <thead>
                    <tr>
                        <td class="pb-2">#</td>
                        <th class="pb-2">Name</th>
                        <th class="pb-2">Email</th>
                        <th class="pb-2">Password</th>
                        <th class="pb-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($users as $key => $user)
                        <tr class="border-t border-gray-700">
                            <td class="py-2">{{$key + 1}}</td>
                            <td class="py-2">{{$user->firstName}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->upass}}</td>
                            <td><span class="text-green-400">
                                <button wire:click="editUserForm({{$user->id}})" type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">Edit User</button>
                            </span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @elseif ($editUser === true)
            <div class="w-full mx-auto">
                <form wire:submit="updateUser" class="max-w-sm mx-auto bg-gray-800 p-6 rounded shadow space-y-4">
                    <label for="amount" class="block text-white text-sm font-medium">Email</label>
                    <input
                        type="email"
                        id="amount"
                        wire:model="email"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />

                    <label for="amount" class="block text-white text-sm font-medium">Password</label>
                    <input
                        type="password"
                        id="amount"
                        wire:model="password"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />

                    <label for="amount" class="block text-white text-sm font-medium">Confirm Password</label>
                    <input
                        type="password"
                        id="amount"
                        wire:model="password_confirmation"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />

                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow"
                    >
                        Update User
                    </button>

                    <button
                        type="button"
                        wire:click="BackTo"
                        class="w-full bg-blue-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded shadow"
                    >
                        Back
                    </button>
                </form>

            </div>
        @endif

        @if($createUser === true)
            <div class="w-full mx-auto">
                <form wire:submit="registerUser" class="max-w-sm mx-auto bg-gray-800 p-6 rounded shadow space-y-4">
                    <label for="amount" class="block text-white text-sm font-medium">First Name</label>
                    <input
                        type="text"
                        id="amount"
                        wire:model="firstName"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    @error('firstName')
                        <p class="text-red-400 text-sm">{{$message}}</p>
                    @enderror

                    <label for="amount" class="block text-white text-sm font-medium">Last Name</label>
                    <input
                        type="text"
                        id="amount"
                        wire:model="lastName"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    @error('lastName')
                        <p class="text-red-400 text-sm">{{$message}}</p>
                    @enderror

                    <label for="amount" class="block text-white text-sm font-medium">Email</label>
                    <input
                        type="email"
                        id="amount"
                        wire:model="email"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    @error('email')
                        <p class="text-red-400 text-sm">{{$message}}</p>
                    @enderror

                    <label for="amount" class="block text-white text-sm font-medium">Password</label>
                    <input
                        type="password"
                        id="amount"
                        wire:model="password"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />
                    @error('password')
                        <p class="text-red-400 text-sm">{{$message}}</p>
                    @enderror

                    <label for="amount" class="block text-white text-sm font-medium">Confirm Password</label>
                    <input
                        type="password"
                        id="amount"
                        wire:model="password_confirmation"
                        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                    />

                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow"
                    >
                        Create User
                    </button>

                    <button
                        type="button"
                        wire:click="BackTo"
                        class="w-full bg-blue-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded shadow"
                    >
                        Back
                    </button>
                </form>

            </div>
        @endif
    </div>