  
<div>

  <style>

    .card-section {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
      padding: 2rem;
      color: black;
    }

    .funding-card {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 20px;
      padding: 1.5rem;
      flex: 1 1 300px;
      max-width: 400px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transition: transform 0.2s ease;
    }

    .funding-card:hover {
      transform: translateY(-5px);
    }

    .funding-card h3 {
      margin-top: 0;
      color: #222;
      font-size: 1.25rem;
    }

    .funding-card ul {
      list-style: none;
      padding: 0;
      margin: 1rem 0;
    }

    .funding-card li {
      padding: 0.5rem 0;
      border-bottom: 1px solid #eee;
    }

    .funding-card button {
      margin-top: 1rem;
      padding: 0.6rem 1.2rem;
      border: none;
      background: #333;
      color: #fff;
      cursor: pointer;
      border-radius: 5px;
      width: 100%;
    }

    @media (max-width: 768px) {
      .card-section {
        flex-direction: column;
        align-items: center;
      }

      .funding-card {
        width: 90%;
      }

      .table-div{
        overflow-x: auto;
        width: 100%;
        margin: auto;
        padding: 5px;
        justify-content: center;
        align-items: flex-start;
      }
    }
  </style>
  
    <h2 style="text-align: center; margin-top: 2rem;">ACCOUNT CONFIGURATION</h2>
    @if (session('success'))
        <p class="alert alert-success" style="text-align: center; color: green;">{{session('success')}}</p>
    @elseif (session('error'))
        <p class="alert alert-danger" style="text-align: center; color: red;">{{session('error')}}</p>
    @endif
    <section class="card-section">
      @if ($paid === false)

        <div class="funding-card">
          <h3 style="text-align: center;">Select challenge type</h3>
          <hr>
          <button wire:click="getEvaluation('evaluation')" type="submit" style="width: auto; border: 1px solid green; border-radius: 40px; {{$evaluation === true ? 'background-color: green;' : ''}}">Evaluation</button>
          <button wire:click="getEvaluation('funding')" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$funding === true ? 'background-color: green;' : ''}}">Fast Funding</button>
          <div>
            <div>
              <h3 style="margin-top: 1.5rem;">Currency</h3>
              <button class="btn btn-primary" style="background-color: green; width: auto; margin-top: -2rem; border: 1px solid green; border-radius: 40px;">$ USD</button>
            </div>

            <div>
              <h3 style="margin-top: 1.5rem;">Balances</h3>
              @if ($evaluation === true)
                  <div>
                <button wire:click="getAmount(1000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 1000 ? 'background-color: green;' : ''}}">$1,000</button>
                <button wire:click="getAmount(5000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 5000 ? 'background-color: green;' : ''}}">$5,000</button>
                <button wire:click="getAmount(10000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 10000 ? 'background-color: green;' : ''}}">$10,000</button>
                <button wire:click="getAmount(20000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 20000 ? 'background-color: green;' : ''}}">$20,000</button>
                <button wire:click="getAmount(50000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 50000 ? 'background-color: green;' : ''}}">$50,000</button>
                <button wire:click="getAmount(100000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 100000 ? 'background-color: green;' : ''}}">$100,000</button>
                <button wire:click="getAmount(200000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 200000 ? 'background-color: green;' : ''}}">$200,000</button>
              </div>
                  @elseif ($funding === true)
                  <div>
                      <button wire:click="getAmount(20000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 20000 ? 'background-color: green;' : ''}}">$20,000</button>
                      <button wire:click="getAmount(50000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 50000 ? 'background-color: green;' : ''}}">$50,000</button>
                      <button wire:click="getAmount(100000)" type="button" style="width: auto; border: 1px solid green; border-radius: 40px; {{$amount === 100000 ? 'background-color: green;' : ''}}">$100,000</button>
                  </div>
              @endif
            </div>
          </div>
        </div>

        @if ($evaluation === true)
        <div class="funding-card">
          <ul style="display: flex; justify-content: right; align-items: flex;">
            <li style="margin-right: 2rem; margin-top: -1.5rem;">Phase 1</li>
            <li style="margin-right: 2rem; margin-top: -1.5rem;">Phase 2</li>
            <li style="margin-top: -1.5rem;">Funded</li>
          </ul>
          <hr>
          <div style="display: flex; justify-content: space-between;">
            <p>Trading Period</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">Unlimited</li>
              <li style="margin-right: 2rem;">Unlimited</li>
              <li>Unlimited</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Leverage</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">1:100</li>
              <li style="margin-right: 2rem;">1:100</li>
              <li>1:100</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Minimum Trading days</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">5 days</li>
              <li style="margin-right: 2rem;">5 days</li>
              <li>X</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Max Daily Loss</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">${{$drawDown}}</li>
              <li style="margin-right: 2rem;">${{$drawDown}}</li>
              <li>${{$drawDown}}</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Max Overall Loss</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">${{$maxDrawDown}}</li>
              <li style="margin-right: 2rem;">${{$maxDrawDown}}</li>
              <li>${{$maxDrawDown}}</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Profit Target</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">${{$profitTarget}}</li>
              <li style="margin-right: 2rem;">${{$profitTargetTwo}}</li>
              <li>X</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Hold over weekend</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">✅</li>
              <li style="margin-right: 2rem;">✅</li>
              <li>✅</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Refundable Fee</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">Single Payment For : ${{$purchaseAmount}}</li>
            </ul>
          </div>
          <!-- <div>
            <h3>Payment method</h3>
            <select name="" id="" style="width: 70%; height: 2.2rem; padding: .2rem auto; text-align: center; border-radius: 5px;">
              <option value="" >Select payment method</option>
              <option value="" >USDT BEP20</option>
              <option value="" >USDT ERC20</option>
            </select>
          </div> -->

          <button wire:click="makePayment" type="button" style="border-radius: 12px; height: 3rem; font-size: 1.25rem;">Select Challenge</button>
        </div>
        @elseif ($funding === true)
        <div class="funding-card">
          <ul style="display: flex; justify-content: right; align-items: flex;">
            <li style="margin-right: 2rem; margin-top: -1.5rem;">Phase 1</li>
            <li style="margin-top: -1.5rem;">Funded</li>
          </ul>
          <hr>
          <div style="display: flex; justify-content: space-between;">
            <p>Trading Period</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">Unlimited</li>
              <li>Unlimited</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Leverage</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">1:100</li>
              <li>1:100</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Minimum Trading days</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">5 days</li>
              <li>X</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Max Daily Loss</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">${{$drawDown}}</li>
              <li style="margin-right: 2rem;">${{$drawDown}}</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Max Overall Loss</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">${{$maxDrawDown}}</li>
              <li style="margin-right: 2rem;">${{$maxDrawDown}}</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Profit Target</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">${{$profitTarget}}</li>
              <li>X</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Hold over weekend</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">✅</li>
              <li>✅</li>
            </ul>
          </div>
          <div style="display: flex; justify-content: space-between;">
            <p>Refundable Fee</p>
            <ul style="display: flex; justify-content: right; align-items: flex;">
              <li style="margin-right: 2rem;">Single Payment For :${{$purchaseAmount}}</li>
            </ul>
          </div>
          <!-- <div>
            <h3>Payment method</h3>
            <select name="" id="" style="width: 70%; height: 2.2rem; padding: .2rem auto; text-align: center; border-radius: 5px;">
              <option value="" >Select payment method</option>
              <option value="" >USDT BEP20</option>
              <option value="" >USDT ERC20</option>
            </select>
          </div> -->

          <button wire:click="makePayment" type="button" style="border-radius: 12px; height: 3rem; font-size: 1.25rem;">Select Challenge</button>
        </div>
        @endif

        @elseif ($paid === true)
        <div class="funding-card">
          <h4 style="text-align: center;">Account details.</h4>
          <p style="text-align: center;">Your metaTrader5 (mt5) login details will be sent to your email shortly.</p>
          <div class="table-div">
            <table style="width: 100%;">
              <thead>
                <tr>
                  <th>Type</th>
                  <th>Size</th>
                  <th>Draw Down</th>
                  <th>Max Draw Down</th>
                  <th>Profit 1</th>
                  @if ($evaluation === true)
                    <th>Profit 2</th>
                  @endif
                </tr>
              </thead>
              <tr>
                <td>{{$funding === true ? 'Funding' : 'Evaluation'}}</td>
                <td>{{$amount}}</td>
                <td>{{$drawDown}}</td>
                <td>{{$maxDrawDown}}</td>
                <td>{{$profitTarget}}</td>
                @if ($evaluation === true)
                  <td>{{$profitTargetTwo}}</td>
                @endif
              </tr>
            </table>
          </div>
        </div>
      @endif
    </section>
</div>