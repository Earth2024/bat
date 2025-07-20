<section class="crypto-picker">
    <h3>
        Deposit Crypto
    </h3>
    @if ($hideWallet === false)
    <div style="width: 95%; margin: auto;">
        <h4>Select USDT Network</h4>
        @error('cryptoName')
            <p style="padding-left: .5rem; color: red; font-size: 12px;">{{$message}}</p>
        @enderror
        <div 
            class="coin-option" 
            data-coin="bep20" 
            x-data 
            @click="
                selectCoin($el);
                $wire.name = $el.getAttribute('data-coin');
            ">
            <img src="{{ url('backend/img/bbep20.png') }}" alt="USDT BEP20" style="border-radius: 50%;">
            <span>USDT (BEP20)</span>
        </div>

        <!-- <div 
            class="coin-option" 
            data-coin="erc20" 
            x-data 
            @click="
                selectCoin($el);
                $wire.name = $el.getAttribute('data-coin');
            ">
            <img src="{{ url('backend/img/berc20.png') }}" alt="USDT ERC20">
            <span>USDT (ERC20)</span>
        </div>

        <div 
            class="coin-option" 
            data-coin="sol" 
            x-data 
            @click="
                selectCoin($el);
                $wire.name = $el.getAttribute('data-coin');
            ">
            <img src="{{ url('backend/img/bsol.png') }}" alt="USDT SOL" style="border-radius: 50%;">
            <span>USDT (Solana)</span>
        </div> -->

        <input type="hidden" wire:model="cryptoName" name="coin" id="selectedCoin" value="">


        <div x-data="{ amount: '' }">
            <label for="amount">Amount (USD)</label>
            <input 
                type="text" 
                wire:model.live="amount" 
                placeholder="amount" 
                id="amount"
                x-model="amount" 
                @input="
                    amount = amount.replace(/[^0-9.]/g, '').slice(0, 8);
                    amount = Math.min(Math.max(amount, 0), 100000)
                "
            >
        </div>
        @error('amount')
            <p style="padding-left: .5rem; color: red; font-size: 12px;">{{$message}}</p>
        @enderror
        <button wire:click="getAddress" type="submit" style="margin: .3rem auto; display: flex;">Proceed to Pay</button>
    </div>


        @elseif ($hideWallet === true)
            <div id="cryptoDepositForm">
                

                <div class="wallet-section">
                    <h4 style="padding-left: .5rem;">Wallet Address</h4>
                    <p style="padding-left: .5rem;">You are to pay {{$amount}} USDT ({{strtoupper($cryptoName)}}) to the below wallet address</p>
                    <div style="">
                        <input type="text" id="walletAddress" wire:model="wallet" readonly>
                        <button type="button" onclick="copyWalletAddress()" style="margin-left: .5rem;">Copy</button>
                    </div>
                </div>

                <button wire:click="goBack" type="submit" style="margin: .3rem auto; display: flex;">Back</button>

            </div>
        @endif
    @section('script')
    <script>
        function selectCoin(element) {
            document.querySelectorAll('.coin-option').forEach(opt => opt.classList.remove('selected'));
            element.classList.add('selected');
        }

    </script>
    @endsection
</section>
