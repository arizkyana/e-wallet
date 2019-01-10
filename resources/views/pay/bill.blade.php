@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pay</div>
                <div class="card-body">
                    <form method="POST" action="{{ action('PayController@pay') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="bill" value="{{ $bill }}" />
                        <div class="row">
                            <div class="col">
                                <div class="form-group text-center">
                                    <label for="">Current Balance</label>
                                    <p class="currency">
                                        {{ $wallet->balance }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><i class="icon ion-ios-cash"></i> Bill</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>School</td>
                                                <th>{{ $bill }}</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm btn-block" type="submit">
                                        Pay
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection