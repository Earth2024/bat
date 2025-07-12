<div class="wallet-balance" style=" justify-content: center; align-items: center;  border: 1px solid rgba(239, 187, 102, 0.6); border-radius: 11px; margin: 4px auto; height: 9rem;" wire:poll.15s>
    <h5 style="margin-top: -0.8rem; height: 1.2rem; padding-top: -1rem; font-size: 14px;">Main Balance</h5>
    @if ($account = auth()->user()->account)
        <h5 style="margin-top: -.1rem; height: 1.2rem; padding-top: -1rem; font-size: 18px;"> {{$account->balance}} USD</h5>
        @else
        <h5 style="margin-top: -.1rem; height: 1.2rem; padding-top: -1rem; font-size: 18px;">0.00 USD</h5>
    @endif
    <h5 style="margin-top: .4rem; height: 1.2rem; padding-top: -1rem; font-size: 13px;">Bot Account Balance</h5>
    @if ($account = auth()->user()->account)

    @if ($bot = $account->botAccount)
        <h5 style="margin-top: -.1rem;  height: 1.2rem; padding-top: -1rem; font-size: 12px;">{{$bot->balance}}</h5>
        @else
        <h5 style="margin-top: -.1rem;  height: 1.2rem; padding-top: -1rem; font-size: 12px;">0.00 USD</h5>
    @endif
    <h5 style="margin-top: .4rem; height: 1.2rem; padding-top: -1rem; font-size: 13px;">Investment/Binary Option Account Balance</h5>
    @if ($opt = $account->optionAccount)
        <h5 style="margin-top: 1rem;  height: 1.2rem; padding-top: -1rem; font-size: 12px;">{{$opt->balance}}</h5>
        @else
        <h5 style="margin-top: -.1rem;  height: 1.2rem; padding-top: -1rem; font-size: 12px;">0.00 USD</h5>
    @endif
    
    @endif
        
</div>