<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Services\TopUpService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{
    private $topup;

    public function __construct(TopUpService $topup){
        $this->topup = $topup;
    }

    public function walletByUser(User $user){
        try{
            $wallet = $this->topup->walletByUser($user);
            return response($wallet);
        } catch(Exception $e){
            return response(['message' => $e->getMessage()], 500);
        }

        
    }
    
    // request topup balance
    
    /**
    * POST
    */
    public function checkout(Request $request){

        $user = Auth::user();

        $checkout = $this->topup->checkout($user, $request->all());
        return response($checkout);
    }
    
    public function submit(Request $request){
        
        $param = $request->all();

        $param['unique_code'] = $request->session()->get('unique_code');

        $param['user'] = Auth::user();

        $submit = $this->topup->submit($param);
        
        return response($submit);
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

        return response($message);
    }
}
