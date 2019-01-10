<?php

namespace App\Http\Controllers;

use App\Pay;
use App\TopUp;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\Models\PayRepository;
use App\Repository\Models\TopUpRepository;
use App\Repository\Models\WalletRepository;

class TopUpController extends Controller
{
    
    protected $topup;
    protected $pay;
    protected $wallet;

    public function __construct(TopUp $topup, Pay $pay, Wallet $wallet){
        $this->middleware('auth');

        $this->topup = new TopUpRepository($topup);
        $this->pay = new PayRepository($pay);
        $this->wallet = new WalletRepository($wallet);
    }
    
    public function index(Request $request){
        // current saldo
        $user = Auth::user();
        $_wallet = $this->wallet->findByUser($user->id);
        return view('topup.index', ['wallet' => $_wallet]);
    }
    
    // request topup balance
    
    /**
    * POST
    */
    public function checkout(Request $request){
        $user = Auth::user();
        $_topup = $request->topup;
        
        $unique_code = $this->unique_code(3); // unit test
        $total = intval($_topup) + $unique_code; // unit test
        
        session(['unique_code' => $unique_code]);
        
        return view('topup.checkout', [
        'user' => $user,
        'topup' => $_topup,
        'total' => $total,
        
        ]);
    }
    
    public function submit(Request $request){
        $user = Auth::user();
        $payment_method = $request->payment_method;
        $total = $request->total;
        $unique_code = $request->session()->get('unique_code');
        
        $_wallet = $this->wallet->findByUser($user->id);
        
        // store to pay
        $_pay = $this->pay->create(
            [
                'total_invoice' => $total,
                'payment_method' => $payment_method,
                'is_confirmed' => false,
                'is_transfered' => false
            ]
        );
        
        // store to topup
        $_topup = $this->topup->create(
            [
                'id_wallet' => $_wallet->id,
                'topup' => $request->topup,
                'is_paid' => false,
                'unique_code' => $unique_code,
                'id_pay' => $_pay->id,
                'source' => $payment_method,
            ]
        );
        
        return view('topup.confirm', [
        'pay' => $_pay,
        'topup' => $_topup
        ]);
    }
    
    /**
     * Confirm
     * @desc
     * - update topup paid status (is_paid = true)
     * - update pay confirmed and transfered (is_confirmed = true, is_transfered = true)
     * - update wallet balance (current balance + topup)
     */
    public function confirm(Request $request){
        
        // update topup paid status (is_paid = true)
        $_topup = $this->topup->updatePaidStatus($request->topup);
        
        // update pay confirmed and transfered (is_confirmed = true, is_transfered = true)
        $this->pay->updateConfirmedAndTransfered($request->pay);

        // update wallet balance (current balance + topup)
        $this->wallet->updateBalance($_topup->topup); 

        return redirect(route('wallet.topup'))->with([
            'message' => [
                'type' => 'success', // bs4 alert class,
                'title' => 'Top Up Success!',
                'content' => 'Your top up is success, please check your current balance'
            ],
            
        ]);
    }
    
    // add to helpers -> as unit test
    private function unique_code($length) {
        $result = '';
        
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        
        return $result;
    }
}