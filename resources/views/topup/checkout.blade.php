@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Checkout</div>

                <div class="card-body">
                  <form method="POST" action="{{ action('TopUpController@submit') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="">Request Top Up</label>
                      <p class="font-weight-bold">
                        {{ $topup }}
                      </p>
                    </div>
                    <div class="form-group">
                      <label for="">Total</label>
                      <p class="font-weight-bolder">
                        {{ $total }}
                      </p>
                    </div>
                    <payment-method></payment-method>

                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="topup" value="{{ $topup }}">

                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-sm btn-block">Checkout</button>
                    </div> 
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection