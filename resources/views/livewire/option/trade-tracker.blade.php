<div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    #toast {
      transition: opacity 0.3s ease-in-out;
    }

    body {
      overflow-x: auto;
      background: #f1f5f9;
    }

    @media (max-width: 1100px) {
      .navbar{
        position: fixed;
      }

      .trade-options {
        width: 10000px;
      }
    }
  </style>

  <div class="px-4 py-6 trade-options" style="width: 1200px; min-width: 1000px; margin: auto;">
    <div class="bg-white rounded-2xl shadow-md p-6 space-y-6">
      <h1 class="text-center text-2xl font-bold text-blue-700">📈 BinaryAi Trade</h1>

      <div class="w-full flex gap-4" style="justify-content: space-between; align-items: flex-start;">

        {{-- Chart Section --}}
        <div class="flex-[3] min-w-[870px]">
          <div id="price" class="text-center text-lg text-gray-700 font-semibold">Price: --</div>
          <div class="overflow-auto">
            <canvas id="chartCanvas"></canvas>
          </div>
        </div>

        {{-- Controls Section --}}
        <div class="flex-[1] min-w-[250px]">
          <div id="derivStatus" class="text-sm text-gray-600 mb-2">🟡 Connecting to BinaryAiTrade...</div>

          <form id="tradeForm" x-data="{ contractType: 'CALL', amount: '' }" class="space-y-4">
            {{-- Symbol Selector --}}
            <div x-data="{
              symbol: 'R_100',
              changeSymbol() {
                ws.send(JSON.stringify({ forget_all: 'ticks' }));
                ws.send(JSON.stringify({ ticks: this.symbol }));
              }
            }">
              <label class="block mb-2 text-sm font-medium text-gray-700">Select Symbol</label>
              <select name="symbol" x-model="symbol" @change="switchSymbol(symbol)"
                      class="w-full border border-gray-300 rounded-lg px-4 py-auto text-blue-800 font-semibold shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                <option value="R_100">R_100</option>
                <option value="R_75">R_75</option>
                <option value="R_25">R_25</option>
                <option value="R_50">R_50</option>
              </select>
            </div>

            <input type="hidden" name="contractType" :value="contractType">

            {{-- Contract Buttons --}}
            <div class="flex gap-3">
              <button type="button"
                      @click="contractType = 'CALL'"
                      :class="contractType === 'CALL' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-600'"
                      class="w-1/2 py-2 rounded-full font-bold">
                🟢 CALL
              </button>
              <button type="button"
                      @click="contractType = 'PUT'"
                      :class="contractType === 'PUT' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-600'"
                      class="w-1/2 py-2 rounded-full font-bold">
                🔴 PUT
              </button>
            </div>
            <div class="flex gap-3">
              {{-- Amount Input --}}
              <input type="number"
                    name="amount"
                    x-model="amount"
                    placeholder="Amount ($)"
                    min="0.5"
                    step="0.01"
                    required
                    class="w-1/2 border border-gray-300 rounded-lg px-4 py-2 text-center text-blue-800 font-semibold shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    <label class=" w-1/2 mb-2 text-sm font-medium text-gray-700" for="">Min Investment 2 USD</label>
            </div>
            {{-- Submit Button --}}
            <button type="submit" id="tradeBtn"
                    class="bg-blue-600 text-white w-full py-auto rounded-lg font-bold transition disabled:opacity-50">
              🚀 Place Trade
            </button>
          </form>

          {{-- Countdown & Result --}}
          <div id="countdown" class="text-center text-sm text-yellow-600 mt-3" wire:ignore>⏳ Time Left: --</div>
          <div id="result" class="text-center text-green-700 font-medium text-base" wire:ignore>💵 Result: --</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Toast Notification --}}
  <div id="toast"
       class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-black text-white text-sm px-4 py-2 rounded-lg shadow-lg opacity-0 hidden">
    --
  </div>

  {{-- Option JS --}}
  <script src="{{ asset('backend/js/option.js') }}"></script>
</div>
