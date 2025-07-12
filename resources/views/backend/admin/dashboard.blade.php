@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
<main class="p-6 md:ml-64">
    <h2 class="text-2xl font-bold mb-4">Welcome, Admin</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white p-4 rounded shadow">Card 1</div>
      <div class="bg-white p-4 rounded shadow">Card 2</div>
      <div class="bg-white p-4 rounded shadow">Card 3</div>
    </div>
</main>
@endsection