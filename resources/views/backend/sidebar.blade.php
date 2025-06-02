<div class="sidebar" id="sidebar">
    <img onclick="menuButton()" src="{{url('backend/img/close.png')}}" alt="" style="cursor: pointer; position: absolute; top: 0; right: .2rem;">
    <div style="display: grid; justify-content: center; margin: auto;">
        <img src="{{url('backend/img/account-circle.png')}}" alt="">
        @if (auth()->user())
            <h5>{{auth()->user()->name}}</h5>
        @endif
    </div>
    <h3>Menu</h3>
    <ul>
        <li>
            <img src="{{url('backend/img/home.png')}}" alt="">
            <a href="{{route('dashboard')}}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Home</a>
        </li>
        <li>
            <img src="{{url('backend/img/wallet-black.png')}}" alt="">
            <a href="" class="" wire:navigate>Live Trade</a>
        </li>
        <li>
            <img src="{{url('backend/img/swap.png')}}" alt="">
            <a href="" class="" wire:navigate>Plans</a>
        </li>
        <li>
            <img src="{{url('backend/img/send.png')}}" alt="">
            <a href="" class="" wire:navigate>Transactions</a>
        </li>
        <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="" class="" wire:navigate>Fund Wallet</a>
        </li>
        <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="" class="" wire:navigate>Place Withdrawal</a>
        </li>
        <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="" class="" wire:navigate>Connect Wallet</a>
        </li>
        <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="" class="" wire:navigate>Referrals</a>
        </li>
        <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="" class="" wire:navigate>My Account</a>
        </li>
        <li>
            <livewire:logout />
        </li>
    </ul>
</div>