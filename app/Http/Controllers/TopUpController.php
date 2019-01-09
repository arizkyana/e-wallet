<?php

namespace App\Http\Controllers;

use App\Pay;
use App\TopUp;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        // current saldo
        $user = Auth::user();
        $wallet = Wallet::where('id_user', $user->id)->first();
        return view('topup.index', ['wallet' => $wallet]);
    }
    
    // request topup balance
    
    /**
    * POST
    */
    public function checkout(Request $request){
        $user = Auth::user();
        $topup = $request->topup;
        
        $unique_code = $this->unique_code(3);
        $total = intval($topup) + $unique_code;
        
        session(['unique_code' => $unique_code]);
        
        
        return view('topup.checkout', [
        'user' => $user,
        'topup' => $topup,
        'total' => $total,
        
        ]);
    }
    
    public function submit(Request $request){
        $user = Auth::user();
        $payment_method = $request->payment_method;
        $total = $request->total;
        $unique_code = $request->session()->get('unique_code');
        
        $wallet = Wallet::where('id_user', $user->id)->first();
        
        // store to pay
        $pay = new Pay();
        $pay->total_invoice = $total;
        $pay->payment_method = $payment_method;
        $pay->is_confirmed = false;
        $pay->is_transfered = false;
        $pay->save();
        
        // store to topup
        
        $topup = new TopUp();
        $topup->id_wallet = $wallet->id;
        $topup->topup = $request->topup;
        $topup->is_paid = false;
        $topup->unique_code = $unique_code;
        $topup->id_pay = $pay->id;
        $topup->source = $payment_method;
        $topup->save();
        
        return view('topup.confirm', [
        'pay' => $pay,
        'topup' => $topup
        ]);
    }
    
    public function confirm(Request $request){
        
        $pay = Pay::find($request->pay);
        $topup = TopUp::find($request->topup);
        
        $pay->is_confirmed = true;
        $pay->is_transfered = true;
        $topup->is_paid = true;
        
        $pay->save();
        $topup->save();
        
        $wallet = Wallet::find($topup->id_wallet);
        
        $wallet->balance += $topup->topup;
        $wallet->save();
        
        return redirect(route('wallet.topup'));
    }
    
    // add to helpers
    private function unique_code($length) {
        $result = '';
        
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        
        return $result;
    }
}