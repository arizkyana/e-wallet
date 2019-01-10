@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pay</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="text-center">
                                <a href="{{ route('wallet.pay.bill') }}">
                                    <i class="icon icon-3x ion-ios-school"></i>
                                    <p>School</p>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <a href="">
                                    <i class="icon icon-3x ion-ios-call"></i>
                                    <p>Phone</p>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center">
                                <a href="">
                                    <i class="icon icon-3x ion-ios-train"></i>
                                    <p>Ticket</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection