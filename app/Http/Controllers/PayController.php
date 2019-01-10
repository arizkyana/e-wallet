<?php

namespace App\Http\Controllers;

use App\Pay;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\Models\PayRepository;
use App\Repository\Models\WalletRepository;

class PayController extends Controller
{

    protected $wallet;
    protected $pay;

    public function __construct(Wallet $wallet, Pay $pay){
        $this->middleware('auth');

        $this->wallet = new WalletRepository($wallet);
        $this->pay = new PayRepository($pay);

    }

    public function index(Request $request){
        return view('pay.index');
    }

    public function bill(Request $request){
        $user = Auth::user();
        $_wallet = $this->wallet->findByUser($user->id);
        return view('pay.bill', [
            'wallet' => $_wallet,
            'bill' => 150000 // constant
        ]);
    }

    public function pay(Request $request){
        // save to pay
        $this->pay->create([
            'total_invoice' => $request->bill,
            'payment_method' => 4, // default for e-wallet payment method
            'is_confirmed' => true,
            'is_transfered' => true    
        ]);
        
        // update wallet
        $this->wallet->updateBalance(-(intval($request->bill)));
        
        return redirect(route('wallet.pay.bill'))->with([
            'message' => [
                'type' => 'success', // bs4 alert class,
                'title' => 'Payment Success!',
                'content' => 'Your payment is success'
            ]
        ]);
    }
}
