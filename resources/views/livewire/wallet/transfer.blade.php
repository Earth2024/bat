
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-purple-100 py-10 px-4 flex items-center justify-center alter-transer-div">
  <div class="bg-white shadow-2xl rounded-xl p-8 max-w-xl w-full space-y-6 alter-transer">
    <h2 class="text-2xl font-bold text-gray-800 text-center">💸 Transfer Funds</h2>

    {{-- Status Message --}}
    @if (session()->has('message'))
      <div class="bg-green-100 text-green-800 px-4 py-2 rounded text-sm">
        {{ session('message') }}
      </div>
      @elseif (session('error'))
      <div class="bg-red-500 text-white p-4 rounded text-sm">
        {{ session('error') }}
      </div>
    @endif

    {{-- Wallet Selection --}}
    <form wire:submit.prevent="transfer">
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
          <label class="block mb-1 text-gray-600 font-medium">From Wallet</label>
          <select wire:model="fromWallet" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <option value="">Select...</option>
            @foreach($wallets as $key => $wallet)
              <option value="{{ $key }}">{{ $wallet['name'] }} (${{ number_format($wallet['balance'], 2) }})</option>
            @endforeach
          </select>
          @error('fromWallet') <span class="text-sm text-red-500">Choose Source Wallet</span> @enderror
        </div>

        <div>
          <label class="block mb-1 text-gray-600 font-medium">To Wallet</label>
          <select wire:model="toWallet" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none">
            <option value="">Select...</option>
            @foreach($wallets as $key => $wallet)
              <option value="{{ $key }}">{{ $wallet['name'] }} (${{ number_format($wallet['balance'], 2) }})</option>
            @endforeach
          </select>
          @error('toWallet') <span class="text-sm text-red-500">Select Receiving Wallet</span> @enderror
        </div>
      </div>

      {{-- Amount Input --}}
      <div class="mt-4">
        <label class="block mb-1 text-gray-600 font-medium">Amount</label>
        <input type="number" min="0.01" step="0.01" wire:model.live="amount"
               class="w-full rounded-lg border border-gray-300 px-4 py-2 text-center focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        @error('amount') <span class="text-sm text-red-500">{{$message}}</span> @enderror
      </div>

      {{-- Submit --}}
      <div class="mt-6 text-center">
        <button type="submit"
        wire:loading.attr="disabled"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition disabled:opacity-50">
          🔁 Transfer Now
        </button>
        <div wire:loading class="text-sm text-gray-500 text-center mt-2">⏳ Processing transfer...</div>

      </div>
    </form>
  </div>
</div>
