@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Top Up</div>

                <div class="card-body">
                    <div class="text-center">
                        <strong>Current Balance</strong> <br />
                        <span class="currency">
                            {{ $wallet->balance }}
                        </span>
                    </div>

                    <div class="row">
                        <div class="col">
                            <form method="POST" action="{{ action('TopUpController@checkout') }}">
                                {{ csrf_field() }}
                                <topup-component></topup-component>
                                {{-- submit --}}
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary btn-block">Top Up</button>
                                </div>
                                {{-- /submit --}}
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection