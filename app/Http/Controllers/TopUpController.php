<?php

namespace App\Http\Controllers;

use App\Pay;
use App\TopUp;
use App\Wallet;
use Illuminate\Http\Request;
use App\Services\TopUpService;
use Illuminate\Support\Facades\Auth;
use App\Repository\Models\PayRepository;
use App\Repository\Models\TopUpRepository;
use App\Repository\Models\WalletRepository;

class TopUpController extends Controller
{

    private $topup;

    public function __construct(TopUpService $topup){
        $this->middleware('auth');
        $this->topup = $topup;
    }
    
    public function index(Request $request){
        $wallet = $this->topup->walletByUser(Auth::user());
        
        return view('topup.index', ['wallet' => $wallet]);
    }
    
    // request topup balance
    
    /**
    * POST
    */
    public function checkout(Request $request){
       
        $checkout = $this->topup->checkout($request->all());
        return view('topup.checkout', $checkout);
    }
    
    public function submit(Request $request){
        
        $param = $request->all();

        $param['unique_code'] = $request->session()->get('unique_code');

        $param['user'] = Auth::user();

        $submit = $this->topup->submit($param);
        
        return view('topup.confirm', $submit);
    }
    
    /**
     * Confirm
     * @desc
     * - update topup paid status (is_paid = true)
     * - update pay confirmed and transfered (is_confirmed = true, is_transfered = true)
     * - update wallet balance (current balance + topup)
     */
    public function confirm(Request $request){
        
        $message = $this->topup->confirm($request->all());

        return redirect(route('wallet.topup'))->with($message);
    }
    
}