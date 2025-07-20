@extends('layouts.admin')
@section('title', 'Admin - Users')
@section('content')
<!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto mt-16 md:mt-0">
      
      <livewire:admin.user.index />

    </main>
@endsection