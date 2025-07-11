@extends('layouts.user')
@section('title', "Binary Ai Crypto Trading - Wallet Transfers")
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
</style>
@endsection
@section('content')

<livewire:wallet.transfer />

@endsection