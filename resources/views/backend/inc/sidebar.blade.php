<div class="sidebar" id="sidebar" style="overflow-y: auto !important; margin-bottom: 3rem; color: black !important;">
    <img onclick="menuButton()" src="{{url('backend/img/close.png')}}" alt="" style="cursor: pointer; position: absolute; top: 0; right: .2rem;">
    <div style="display: grid; justify-content: center; margin: auto;">
        <!-- <img src="{{url('backend/img/account-circle.png')}}" alt=""> -->
        @if (auth()->user())
            <h5>{{auth()->user()->firstName}}</h5>
        @endif
    </div>
    <!-- <h3 style="margin-top: -2rem;">Menu</h3> -->
    <ul>
        <li>
            <img src="{{url('backend/img/home.png')}}" alt="">
            <a href="{{route('dashboard')}}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        </li>
        <li>
            <img src="{{url('backend/img/wallet-black.png')}}" alt="">
            <a href="{{route('evaluation.create')}}" class="">Get Funded</a>
        </li>
        <li>
            <img src="{{url('backend/img/swap.png')}}" alt="">
            <a href="{{route('bot.create')}}">Get a Bot</a>
        </li>
        <li>
            <img src="{{url('backend/img/send.png')}}" alt="">
            <a href="{{route('option')}}">Binary Option</a>
        </li>
        <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="">Monthly Contest</a>
        </li>
        <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="" class="" wire:navigate>Account</a>
        </li>
        <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="" class="" wire:navigate>Profile</a>
        </li>
        <!-- <li>
            <img src="{{url('backend/img/profile-img.png')}}" alt="" style="width: 30px; height: 30px;">
            <a href="" class="" wire:navigate>My Account</a>
        </li> -->
        <li>
            <livewire:logout />
        </li>
    </ul>
</div>