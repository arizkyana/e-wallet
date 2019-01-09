@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Confirm</div>

                <div class="card-body">
                  <form method="POST" action="{{ action('TopUpController@confirm') }}">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="pay" value="{{ $pay->id }}">
                    <input type="hidden" name="topup" value="{{ $topup->id }}">

                    <p>
                      Please confirm after make payment
                    </p>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-sm btn-block">Payment Confirmation</button>
                    </div> 
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection