@extends('layouts.user')
@section('title', "Binary Ai Crypto Trading - Dashboard")
@section('style')
<style>
    .crypto-picker {
    max-width: 500px;
    margin: 2rem auto;
    padding: 1.5rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 0 12px rgba(0,0,0,0.08);
    font-family: Arial, sans-serif;
    }

    .crypto-picker h3 {
    text-align: center;
    margin-bottom: 1.5rem;
    }

    .coin-option {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: #f5f5f5;
    border: 2px solid #ccc;
    padding: 1rem;
    border-radius: 10px;
    margin-bottom: 1rem;
    cursor: pointer;
    transition: all 0.2s ease;
    }

    .coin-option:hover {
    border-color: #007bff;
    background: #e9f5ff;
    }

    .coin-option.selected {
    border-color: #28a745;
    background-color: #e6f7ec;
    }

    .coin-option img {
    width: 32px;
    height: 32px;
    }

    .crypto-deposit-section {
    background: #f7f9fc;
    padding: 2rem;
    border-radius: 10px;
    max-width: 500px;
    margin: 2rem auto;
    font-family: Arial, sans-serif;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .crypto-deposit-section h2 {
    text-align: center;
    margin-bottom: 1rem;
    }

    .crypto-deposit-section form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    }

    .crypto-deposit-section, input,
    .crypto-deposit-section select {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    width: 100%;
    }

    .wallet-section {
    display: block;
    gap: 0.5rem;
    align-items: center;
    }

    .wallet-section button {
    padding: 8px 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    }

    button[type="submit"] {
    background-color: #28a745;
    color: white;
    font-weight: bold;
    border: none;
    padding: 12px;
    border-radius: 6px;
    cursor: pointer;
    }

    input{
        width: 90%;
        height: 2.1rem;
        margin: auto;
        display: block;
        border: 4px solid inherit;
    }

</style>
@endsection
@section('content')
        
    <livewire:deposit.deposit />

@section('script')
<script>
  function copyWalletAddress() {
    const walletInput = document.getElementById('walletAddress');
    walletInput.select();
    walletInput.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(walletInput.value);
    alert('Wallet address copied!');
  }

  document.getElementById('cryptoDepositForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const coin = document.getElementById('coin').value;
    const amount = document.getElementById('amount').value;

    if (!coin || amount < 1) {
      alert("Please select a coin and enter a valid amount.");
      return;
    }

    // For Laravel, you can send this via AJAX or form action route
    document.getElementById('confirmationMessage').style.display = 'block';
    this.reset();
  });
</script>

<script>
  // function selectCoin(element) {
  //   document.querySelectorAll('.coin-option').forEach(opt => opt.classList.remove('selected'));
  //   element.classList.add('selected');
  //   const coin = element.getAttribute('data-coin');
  //   document.getElementById('selectedCoin').value = coin;
  // }
</script>


@endsection

@endsection