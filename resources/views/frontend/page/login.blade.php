@extends('layouts.frontend')
@section('title', 'BinaryAiTrade - Login')
<style>
    input{
        width: 90% !important;
        margin: auto !important;
        display: block !important;
    }

    label{
        padding: 1rem;
    }
</style>
@section('content')

    <div style="max-width: 450px; margin: 2rem auto;">
        <h1 style="text-align: center; margin-bottom: 1.3rem;">WELCOME BACK!</h1>
        <p style="text-align: center; margin-bottom: 1.3rem;">Please enter your details</p>
        @if (session('success'))
            <div>
                <span class="alert alert-success">{{session('success')}}</span>
            </div>
        @endif
        <form action="{{route('bat.login')}}" method="post">
            @csrf
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

            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
            <label>
            <input type="checkbox" name="remember"> Remember me
            </label>

            <label for="">
                <a href="">Forget password</a>
            </label>
            </div>
            <label for="">
                <a href="{{url('register')}}">Don't have an account? Register</a>
            </label>

            <button type="submit">LOGIN</button>
        </form>
    </div>

@endsection