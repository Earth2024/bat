@extends('layouts.user')
@section('title', "Binary Ai Crypto Trading - Investment options")
@section('style')
<link rel="stylesheet" href="{{url('backend/css/option.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
@endsection
@section('content')

    <livewire:option.trade-tracker />


@endsection
