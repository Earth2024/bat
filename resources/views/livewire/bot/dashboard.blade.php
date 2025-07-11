<div
  x-data
  @trade-updated.window="$wire.handleTradeUpdate($event.detail)"
  class="bg-gray-900 text-white p-6 font-sans"
>

  <h1 class="text-3xl font-bold text-cyan-400 mb-6">🤖 AI Trading Bot</h1>
  @if (session('status'))
    @elseif (session('error'))
    <span>{{session('error')}}</span>
  @endif
  <form wire:submit.prevent="submit" class="space-y-4 max-w-xl mb-10">
    <!-- Strategy -->
    <div>
      <label class="block text-sm">Strategy</label>
      <select wire:model="strategy" class="w-full p-2 bg-gray-800 rounded">
        <option value="1">Strategy 1 – RSI + EMA</option>
        <option value="2">Strategy 2 – Multi-layer</option>
        <option value="3">Strategy 3 – OB + FVG</option>
        <option value="4">Strategy 4 – Trendline + EMA</option>
        <option value="5">Strategy 5 – Candle patterns</option>
      </select>
    </div>

    <!-- Symbol -->
    <div>
      @error('symbol')
        <span>Please select a Strategy</span>
      @enderror
      <label class="block text-sm">Symbol</label>
      <select wire:model="symbol" class="w-full p-2 bg-gray-800 rounded">
        <optgroup label="Step Indices">
          <option value="Step Index">Step Index</option>
          <option value="Step Index 2">Step Index 2</option>
          <option value="Step Index 3">Step Index 3</option>
        </optgroup>
        <optgroup label="Volatility Indices">
          <option value="Volatility 25 Index">Volatility 25 Index</option>
          <option value="Volatility 50 Index">Volatility 50 Index</option>
          <option value="Volatility 75 Index">Volatility 75 Index</option>
        </optgroup>
        <optgroup label="Forex & Crypto">
          <option value="XAUUSD">XAUUSD</option>
          <option value="US30">US30</option>
          <option value="SOLUSD">SOLUSD</option>
          <option value="BITUSD">BITUSD</option>
        </optgroup>
      </select>
    </div>

    <!-- Lot -->
    <div>
      @error('lot')
        <span>{{$message}}</span>
      @enderror
      <label class="block text-sm">Lot</label>
      <input type="number" wire:model="lot" step="0.001" class="w-full p-2 bg-gray-800 rounded" required />
    </div>

    <!-- SL and TP -->
    <div class="grid grid-cols-2 gap-4">
      <div>
        @error('sl')
          <span>{{$message}}</span>
        @enderror
        <label class="block text-sm">SL (USD)</label>
        <input type="number" min="1" step="0.01" wire:model="sl" class="w-full p-2 bg-gray-800 rounded" />
      </div>
      <div>
        @error('tp')
        <span>{{$message}}</span>
        @enderror
        <label class="block text-sm">TP (USD)</label>
        <input type="number" min="1" step="0.01" wire:model="tp" class="w-full p-2 bg-gray-800 rounded" />
      </div>
      <div>
        @error('tsl')
        <span>{{$message}}</span>
        @enderror
        <label class="block text-sm">Trailing stopLoss (USD)</label>
        <input type="number" min="0" step="1" wire:model="tsl" class="w-full p-2 bg-gray-800 rounded" />
      </div>
    </div>

    <button type="submit" class="w-full py-2 bg-cyan-500 hover:bg-cyan-600 rounded text-black font-bold">
      🚀 Place Trade
    </button>
  </form>

  <!-- Trade History Table -->
  <div class="overflow-x-auto">
    <table class="min-w-full bg-gray-800 rounded-lg overflow-hidden text-sm">
      <thead class="bg-gray-700 text-cyan-300">
        <tr>
          <th class="px-4 py-2 text-left">Time</th>
          <th class="px-4 py-2 text-left">Symbol</th>
          <th class="px-4 py-2 text-left">Ticket</th>
          <th class="px-4 py-2 text-left">Volume</th>
          <th class="px-4 py-2 text-left">SL</th>
          <th class="px-4 py-2 text-left">TP</th>
          <th class="px-4 py-2 text-left">Price</th>
          <th class="px-4 py-2 text-left">Status</th>
          <th class="px-4 py-2 text-left">PNL</th>
          <th class="px-4 py-2 text-left">Action</th>
        </tr>
      </thead>
      <tbody class="text-white" wire:poll>
     
          @if ($trades)
            @foreach ($trades as $trade)
              @if (\Carbon\Carbon::parse($trade->placed_time)->addMinutes(300) > \Carbon\Carbon::now())
                <tr>
                  <td class="px-4 py-2">{{ $trade->placed_time ?? "-" }}</td>
                  <td class="px-4 py-2">{{ $trade->symbol ?? "-" }}</td>
                  <td class="px-4 py-2">{{ $trade->ticket ?? "-" }}</td>
                  <td class="px-4 py-2">{{ $trade->lot ?? "-" }}</td>
                  <td class="px-4 py-2">{{ $trade->sl ?? "-" }}</td>
                  <td class="px-4 py-2">{{ $trade->tp ?? "-" }}</td>
                  <td class="px-4 py-2">{{ $trade->price ?? "-" }}</td>
                  <td class="px-4 py-2">{{ $trade->status ?? "-" }}</td>
                  <td class="px-4 py-2">{{ $trade->pnl ?? "-" }}</td>
                  <td class="px-4 py-2">
                    @if ($trade->status === 'pending')
                      <button class="btn btn-primary" type="button">Close</button>
                      @elseif ($trade->status === 'executed')
                        <button wire:click.prevent="stopTrade({{ $trade->ticket }})" wire:loading.attr="disabled">
                          Stop Trade
                        </button>
                        @elseif ($trade->status === 'closed')
                        <button class="btn btn-primary" type="button">Closed</button>                      
                    @endif
                  </td>
                </tr>
              @endif
            @endforeach
          @endif
     
      </tbody>
    </table>
  </div>
  
  <script>
    const eventSource = new EventSource("http://127.0.0.1:3000/stream");

    eventSource.onmessage = function(event) {
        const data = JSON.parse(event.data);
        console.log(data);
        window.dispatchEvent(new CustomEvent('trade-updated', { detail: data }));
    };
</script>


</div>
