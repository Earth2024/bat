@extends('layouts.frontend')
@section('title', 'BinaryAiTrade - Register')
@section('content')

    <div style="max-width: 450px; margin: 2rem auto;">
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

            <livewire:country />

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

            <button type="submit">OPEN AN ACCOUNT</button>
        </form>
    </div>

@endsection