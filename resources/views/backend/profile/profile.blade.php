@extends('layouts.user')
@section('title', "Binary Ai Crypto Trading - Transfer")
@section('style')
<style>
    @media(max-width:420px){
        .alter-transer-div{
            min-width: 98dvw;
        }

        .alter-transfer{
            width: 100%;
        }
    }

    .input-field {
        @apply w-full md:w-1/2 lg:w-1/3 px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500;
      }

      input{
        border: 3px solid black;
        height: 2.2rem;
        border-radius: 6px;
        margin-top: 0.3rem !important;

      }
</style>
@endsection
@section('content')
<div>

    <form class="space-y-6">
    <!-- Password Update -->
     <livewire:profile.password />
    

    <!-- PIN Update -->
    <livewire:profile.pin />

    <!-- Contact Details -->
    <livewire:profile.contact />

    
    </form>

</div>
<script>
  function toggleVisibility(inputId, button) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
      input.type = "text";
      button.textContent = "🙈";
    } else {
      input.type = "password";
      button.textContent = "👁️";
    }
  }
</script>

@endsection