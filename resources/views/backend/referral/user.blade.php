@extends('layouts.user')
@section('title', "Binary Ai Crypto Trading - Dashboard")
@section('content')
    <div class="container" style="">

        <livewire:referral.user />

    </div>

    <script>
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
    </script>
@endsection