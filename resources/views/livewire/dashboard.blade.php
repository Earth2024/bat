@extends('layouts.user')
@section('title', "Binary Ai Crypto Trading - Dashboard")

@section('content')
    <div class="container" style="">
        <div class="main-content">
            <div class="profile-card" style="position: relative;">
                <span class="qrcode" style="" id="qrcode"></span>
                <div class="details"> 
                    @if (auth()->user())
                        <h2>{{auth()->user()->name}}</h2>
                        <p> <span>@</span>{{explode( '@', auth()->user()->email)[0]}}</p>
                        <p>{{\Carbon\Carbon::parse(auth()->user()->created_at)->format('d F Y')}}</p>
                    @endif
                </div>

                <h4 style="display: block; position: absolute; top: 0; right: 0;"><img style="background-color:  #ff5722; fill:  #ff5722; width: 40px; height: 50px;" src="{{url('backend/img/Empirekit.png')}}" alt="Profile Picture"></h4>
                <h4 style="position: absolute; bottom: 0; right: 9px; border-radius: 30px; background-color: rgb(215, 105, 85); color: white; padding: 5px 10px;">
                        <span>0</span>
                    <span> Referral</span>
                </h4>
            </div>
            <div class="wallet-section">
                <div class="wallet-header" style="display: flex; justify-content: space-between !important; align-items: flex-start !important; margin: auto;">
                    <h4 class="wallet-overview" style="font-size: 23px; margin-top: -1rem;">Wallet Overview</h4>
                    <span><img src="{{url('backend/img/eye.png')}}" alt="Wallet Icon" style="width: 27px; height: 27px;"></span>
                </div>
                <div style="margin-top: -1.3rem;">Manage your tokens</div>
                
                
                
                <div class="wallet-balance" style=" justify-content: center; align-items: center;  border: 1px solid rgba(239, 187, 102, 0.6); border-radius: 11px; margin: 4px auto;">
                    <h5 style="margin-top: .4rem; height: 1.2rem; padding-top: -1rem; font-size: 14px;">Balance</h5>
                    <h5 style="margin-top: -.1rem; height: 1.2rem; padding-top: -1rem; font-size: 18px;">0.00 EMP</h5>
                    <h6 style="margin-top: -.1rem;  height: 1.2rem; padding-top: -1rem; font-size: 11px;">= 0.00 USD</h6>
                </div>
            </div>
        </div>
        <div class="wallet-actions" style=" margin-bottom: 2rem; padding: 10px; display: flex; justify-content: space-between; align-items: center;">
            <button onclick="copyLink()">Copy Link 
                <span style="font-size: 9px;" id="refLink"></span>
            </button>
            <button onclick="shareProfile()">Share Profile</button>
            <button>Open Wallet</button>
        </div>
    </div>
    
    @section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ethers/6.6.1/ethers.umd.min.js"></script>
    <script src="https://unpkg.com/@solana/web3.js@latest/lib/index.iife.min.js"></script>

    <script src="{{url('userWallet/wallets.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <script>
        //#F19E39
        let walletAddress = "Okay for now"; // Replace with actual address
        new QRCode(document.getElementById("qrcode"), {
            text: walletAddress,
            width: 150,
            height: 150,
        });

        function startCountdown(duration) {
            let timer = duration, hours, minutes, seconds;
            setInterval(function () {
                hours = Math.floor(timer / 3600);
                minutes = Math.floor((timer % 3600) / 60);
                seconds = timer % 60;
                if (--timer < 0) {
                    //timer = duration;
                    document.getElementById("countdown").textContent = 'Claim token';
                }else{
                document.getElementById("countdown").textContent = `${hours}h ${minutes}m ${seconds}s`;
                }
            }, 1000);
        }

       
        window.onload = function () {
            startCountdown(123456789);
        };

        function copyLink(ref) {
                const link = `${ref}`; // Replace with your actual link
                navigator.clipboard.writeText(link)
                    .then(() => {
                    const status = document.getElementById("refLink");
                    status.textContent = "Copied!";
                    
                    // Clear the text after 5 seconds
                    setTimeout(() => {
                        status.textContent = "";
                    }, 5000);
                    })
                    .catch(err => console.error("Failed to copy: ", err));
        }


    function shareProfile() {
        const profileLink = "okay for now"; // Replace with the actual profile URL

        if (navigator.share) {
            navigator.share({
                title: "Refer a friend to Empire Kit",
                text: "Use this link to join Empire Kit!",
                url: profileLink
            })
            .then(() => console.log("Profile shared successfully"))
            .catch((error) => console.log("Error sharing profile:", error));
        } else {
            // Fallback for browsers that don’t support Web Share API
            navigator.clipboard.writeText(profileLink);
            alert("Profile link copied! You can paste it anywhere to share.");
        }
    }
    </script>
    @endsection
@endsection