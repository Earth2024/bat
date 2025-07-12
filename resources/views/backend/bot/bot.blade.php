@extends('layouts.user')
@section('title', "BinaryAITrade - Purchase Expert Adviser (BOT)")
@section('style')
    <link rel="stylesheet" href="{{url('backend/css/bot.css')}}">
@endsection

@section('content')
  <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
  @if (session('error'))
    <p class="text-center text-red-600 font-semibold mb-4">{{ session('error') }}</p>
  @endif

  <h1 class="text-center text-2xl font-bold text-gray-800 mb-6">I HAVE A KEY</h1>

  <form action="{{ route('bot.store') }}" method="post" class="space-y-4">
    @csrf
    <input
      type="text"
      name="botKey"
      placeholder="Enter your key"
      style="color: black !important;"
      class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
    <button
      type="submit"
      class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200"
    >
      ENTER THE KEY
    </button>
  </form>
</div>

  <p style="text-align: center; color: black;">Purchase a new key</p>
  <livewire:bot.ai />
@endsection