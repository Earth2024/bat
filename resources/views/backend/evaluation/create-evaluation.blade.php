@extends('layouts.user')
@section('title', "Binary Ai Crypto Trading - Dashboard")
@section('style')
<style>
    body {
      margin: 0;
      background-color: #1a1a2e;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: white;
    }
    .header {
      background-color: #0f3460;
      text-align: center;
      padding: 20px 10px;
    }
    .header h1 {
      margin: 0;
      font-size: 2rem;
    }
    .container {
      display: flex;
      justify-content: center;
      gap: 20px;
      padding: 40px;
      flex-wrap: wrap;
    }
    .card {
      background-color: #2e2e4d;
      border-radius: 10px;
      padding: 20px;
      width: 280px;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }
    .card h2 {
      margin-top: 0;
      color: #00adb5;
    }
    .card p {
      margin: 6px 0;
    }
</style>
@endsection
@section('content')

  <div class="create-evaluate">
    @livewireStyles()
    <livewire:evaluation.purchase />
    @livewireScripts()
  </div>

@endsection