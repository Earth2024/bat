@extends('layouts.frontend')
@section('title', 'BinaryAiTrade - Register')
<style>
    input{
        display: block !important;
        width: 90% !important;
        margin: auto !important;
    }

    label{
        padding: 1rem;
    }
</style>
@section('content')

    <div style="max-width: 450px; margin: 2rem auto; display: flex; flex-direction: column; justify-content: center;  ">
        <h2 style="text-align: center; margin-bottom: 1.3rem;">CREATE AN ACCOUNT</h2>
        <form action="{{route('bat.register')}}" method="post">
            @csrf
            <label for="firstname">Firstname</label>
            <input type="text" id="firstname" name="firstName">
            @error('firstName')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror

            <label for="lastname">Lastname</label>
            <input type="text" id="lastname" name="lastName">
            @error('lastName')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror

            <div class="w-full mx-auto mt-5">
                <livewire:country />
            </div>

            <label for="email" style="margin-top: 1rem;">E-mail</label>
            <input type="email" id="email" name="email">
            @error('email')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror

            <label for="email" style="margin-top: 1rem;">Password</label>
            <input type="password" id="email" name="password">
            @error('password')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror

            <label for="email" style="margin-top: 1rem;">Confirm password</label>
            <input type="password" id="email" name="password_confirmation">
            @error('password_confirmation')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror

            @error('terms')
                <span class="alert alert-danger">{{$message}}</span>
            @enderror
            <label>
            <input type="checkbox" name="terms" value="1" /> I accept the <a href="#">Terms and Conditions</a>
            </label>
            <label for="">
                <a href="{{url('login')}}">Already have an account? Login</a>
            </label>
            <input type="hidden" name="ref" id="referral-code">

            <button type="submit">OPEN AN ACCOUNT</button>
        </form>
    </div>

    <script>
    const urlParams = new URLSearchParams(window.location.search);
    const referralCode = urlParams.get('ref');

    if (referralCode) {
        const expiryDate = new Date();
        expiryDate.setMonth(expiryDate.getMonth() + 1);

        localStorage.setItem('referralCode', referralCode);
        localStorage.setItem('referralExpiry', expiryDate.getTime());
    }
</script>

<script>
    const storedCode = localStorage.getItem('referralCode');
    const storedExpiry = localStorage.getItem('referralExpiry');

    if (storedCode && storedExpiry) {
        const now = Date.now();
        if (now <= parseInt(storedExpiry)) {
            const ref = localStorage.getItem('referralCode');
        if (ref) {
            document.getElementById('referral-code').value = ref;
        }
        } else {
            // Code expired
            localStorage.removeItem('referralCode');
            localStorage.removeItem('referralExpiry');
        }
    }
</script>
@endsection