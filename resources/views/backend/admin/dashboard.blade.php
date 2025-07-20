@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
<!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto mt-16 md:mt-0">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Cards -->
        <div class="bg-gray-700 p-4 rounded shadow">
          <h3 class="text-lg font-semibold">Total Assets</h3>
          @if ($bal = \App\Models\Account::all()->sum('balance'))
            <p class="text-2xl mt-2">${{$bal}}</p>
            @else
            <p class="text-2xl mt-2">0</p>
          @endif
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h3 class="text-lg font-semibold">Company Assets</h3>
          @if ($com = \App\Models\CompanyAccount::where('email', 'nigakool@gmail.com')->first())
            <p class="text-2xl mt-2">${{$com->balance}}</p>
            @else
            <p class="text-2xl mt-2">0</p>
          @endif
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h3 class="text-lg font-semibold">Active Users</h3>
          @if ($users = \App\Models\User::all())
            <p class="text-2xl mt-2">{{$users->count()}}</p>
            @else
            <p class="text-2xl mt-2">0</p>
          @endif
        </div>
      </div>

      <!-- Charts & Tables -->
      <div class="bg-gray-800 p-6 rounded shadow mb-6">
        <h3 class="text-xl font-semibold mb-4">Market Trends</h3>
        <div class="h-64 bg-gray-700 flex items-center justify-center rounded">📈 Chart Placeholder</div>
      </div>

      <div class="bg-gray-800 p-6 rounded shadow">
        <h3 class="text-xl font-semibold mb-4">Recent Transactions</h3>
        <table class="w-full text-left table-auto">
          <thead>
            <tr>
              <th class="pb-2">User</th>
              <th class="pb-2">Asset</th>
              <th class="pb-2">Amount</th>
              <th class="pb-2">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t border-gray-700">
              <td class="py-2">Ibrahim</td>
              <td>BTC</td>
              <td>0.3</td>
              <td><span class="text-green-400">Completed</span></td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="py-2">Fatima</td>
              <td>ETH</td>
              <td>5</td>
              <td><span class="text-yellow-400">Pending</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
@endsection