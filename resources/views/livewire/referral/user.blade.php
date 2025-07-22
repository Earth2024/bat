<div class="p-4 max-w-4xl mx-auto">
  <!-- Header -->
  <div class="text-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Referral Dashboard</h2>
    <p class="text-sm text-gray-500 dark:text-gray-400">Track your invites and rewards</p>
  </div>

  <!-- Referral Link Section -->
  <div class="bg-white dark:bg-gray-800 shadow rounded p-4 mb-4">
    @if (session('error'))
        <div class="max-w-md mx-auto mt-4 px-4 py-3 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-md flex items-start space-x-3">
            <!-- Icon -->
            <svg class="w-5 h-5 text-red-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path d="M8.257 3.099c.366-.756 1.42-.756 1.786 0l6.518 13.464A1 1 0 0115.518 18H4.482a1 1 0 01-.893-1.437L10.107 3.1zM11 14a1 1 0 10-2 0 1 1 0 002 0zm-1-2a1 1 0 01-1-1V9a1 1 0 012 0v2a1 1 0 01-1 1z"/>
            </svg>

            <!-- Message -->
            <div class="flex-1 text-sm">
            <strong class="block font-semibold">Error:</strong>
            <span>{{ session('error') }}</span>
            </div>
        </div>
        @elseif (session('success'))
        <div class="max-w-md mx-auto mt-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-md flex items-start space-x-3">
            <!-- Icon -->
            <svg class="w-5 h-5 text-green-500 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
            </svg>

            <!-- Message -->
            <div class="flex-1 text-sm">
            <strong class="block font-semibold">Success:</strong>
            <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <label class="text-sm font-semibold text-gray-700 dark:text-gray-200">Your Referral Link:</label>
    <div class="mt-2 flex items-center">
      <input type="text" value="{{$url}}" readonly class="flex-1 px-3 py-2 border rounded-l border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100" />
      <button onclick="copyLink('{{$url}}')" class="bg-blue-600 text-white px-4 py-2 rounded-r hover:bg-blue-700" id="refLink">Copy</button>
    </div>
  </div>

  <!-- Stats Section -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center text-sm text-gray-600 dark:text-gray-300">
    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded shadow">
      <p class="font-bold text-xl">{{$users->count()}}</p>
      <p>Signups</p>
    </div>
    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded shadow">
      <p class="font-bold text-xl">$5.00</p>
      <p>Minimum Withdrawal</p>
    </div>
    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded shadow">
      <p class="font-bold text-xl">${{isset($refwithdrawalAmount) ? $refwithdrawalAmount : 0}}</p>
      <p>Rewards Earned</p>
    </div>
    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded shadow">
      <p class="font-bold text-xl">${{isset($refAmount->balance) ? $refAmount->balance : 0}}</p>
      <p>Available Balance</p>
      <button wire:click="withdrawFund" type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded w-full sm:w-auto">
        Withdraw fund
      </button>
    </div>
  </div>

  <!-- Referred Users Table -->
  <div class="bg-white dark:bg-gray-800 shadow rounded p-4 mt-6 overflow-x-auto">
    <h3 class="text-md font-semibold text-gray-700 dark:text-gray-200 mb-2">Referred Users</h3>
    <table class="min-w-full text-left text-sm">
      <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
          <th class="px-4 py-2">Name</th>
          <th class="px-4 py-2">Email</th>
          <th class="px-4 py-2">Joined</th>
          <th class="px-4 py-2">Status</th>
        </tr>
      </thead>
      <tbody>
        @if ($users)
            @foreach ($users as $user)
                <tr class="border-t border-gray-300 dark:border-gray-600">
                    <td class="px-4 py-2">{{$user->firstName}}</td>
                    <td class="px-4 py-2">{{$user->email}}</td>
                    <td class="px-4 py-2">{{\Carbon\Carbon::parse($user->created_at)->format("d F, Y")}}</td>
                    @if ($user->referral_code)
                        <td class="px-4 py-2 text-green-600">Verified</td>
                        @else
                        <td class="px-4 py-2 text-yellow-600">Pending</td>
                    @endif
                </tr>
            @endforeach
        @endif
      </tbody>
    </table>
  </div>

  <!-- Share Section -->
  <div class="bg-white dark:bg-gray-800 shadow rounded p-4 mt-6">
    <h3 class="text-md font-semibold text-gray-700 dark:text-gray-200 mb-2">Share Your Link</h3>
    <div class="flex space-x-4">
      <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">WhatsApp</button>
      <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Email</button>
      <button class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Copy</button>
    </div>
  </div>
</div>