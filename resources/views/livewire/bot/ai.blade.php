<div>
  @if (session('success'))
    <p class="alert alert-success" style="color: green; text-align: center;">{{session('success')}}</p>
    @elseif (session('error'))
    <p class="alert alert-danger" style="color: red; text-align: center;">{{session('error')}}</p>
  @endif
  @if ($paid === false)
  <section class="pricing-container">
      <div class="card">
        <div class="icon">🧪</div>
        <h4>For beginner traders</h4>
        <h2>BASIC KEY</h2>
        <p class="price">$35</p>
        <p  style="color: #ffde59 !important;">2-week key</p>
        <button wire:click="buyBot(35, 'BASIC', '{{now()->addDays(14)}}')">BUY</button>
      </div>
      <div class="card">
        <div class="icon">✨</div>
        <h4>For curious starters</h4>
        <h2>LITE KEY</h2>
        <p class="price">$80</p>
        <p  style="color: #ffde59 !important;">5-week key</p>
        <button wire:click="buyBot(80, 'LITE', '{{now()->addDays(35)}}')">BUY</button>
      </div>
      <div class="card featured">
        <div class="icon">🚀</div>
        <h4>For committed traders</h4>
        <h2>STANDARD KEY</h2>
        <p class="price">$200</p>
        <p  style="color: #ffde59 !important;">3-month key</p>
        <button wire:click="buyBot(200, 'STANDARD', '{{now()->addDays(90)}}')">BUY</button>
      </div>
      <div class="card">
        <div class="icon">👑</div>
        <h4>For seasoned pros</h4>
        <h2>PREMIUM KEY</h2>
        <p class="price">$370</p>
        <p style="color: #ffde59;">6-month key</p>
        <button wire:click="buyBot(370, 'PREMIUM', '{{now()->addDays(180)}}')">BUY</button>
      </div>
      <div class="card">
        <div class="icon">💼</div>
        <h4>For elite traders</h4>
        <h2>VIP KEY</h2>
        <p class="price">$650</p>
        <p style="color: #ffde59;">12-month key</p>
        <button wire:click="buyBot(650, 'VIP', '{{now()->addDays(365)}}')">BUY</button>
      </div>
  </section>
  @elseif ($paid === true)
  <section class="pricing-container">
    <div class="card">
      <h4>Your newly purchased bot details</h4>
      <p>Plan: <strong>{{$plan}}</strong> </p>
      <p>Amount: <strong>{{$amount}}</strong></p>
      <p>Bot Key <strong>{{$botKey}}</strong></p>
      <p>Expiry Date: <strong>{{$expires_at->format('F d, y')}}</strong></p>
      <p>Minimum Bot Deposit: <strong>{{$amount * 0.4}}</strong></p>
    </div>
  </section>
   @endif
</div>