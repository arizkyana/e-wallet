<?php

namespace App\Services;

use App\Pay;
use App\User;
use App\TopUp;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\Models\PayRepository;
use App\Repository\Models\TopUpRepository;
use App\Repository\Models\WalletRepository;

class TopUpService {
    
    private $topup;
    private $pay;
    private $wallet;

    public function __construct(TopUp $topup, Pay $pay, Wallet $wallet){

        $this->topup = new TopUpRepository($topup);
        $this->pay = new PayRepository($pay);
        $this->wallet = new WalletRepository($wallet);

    }

    public function walletByUser(User $user): Wallet{
        
        return $this->wallet->findByUser($user->id);
    }

    public function checkout(User $user, $param): Array{
        $_topup = $param['topup'];
        $total = $this->generateTotal($_topup);

        return [
            'user' => $user,
            'topup' => $_topup,
            'total' => $total
        ];
    }

    public function submit($param): Array{
        
        $payment_method = $param['payment_method'];
        $total = $param['total'];
        $unique_code = $param['unique_code'];
        $user = $param['user'];
        
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
                'topup' => $param['topup'],
                'is_paid' => false,
                'unique_code' => $unique_code,
                'id_pay' => $_pay->id,
                'source' => $payment_method,
            ]
        );
        
        return [
            'pay' => $_pay,
            'topup' => $_topup
        ];
        
    }

    public function confirm($param): Array{
        
        // update topup paid status (is_paid = true)
        try{
            $_topup = $this->topup->updatePaidStatus($param['topup']);
        
            // update pay confirmed and transfered (is_confirmed = true, is_transfered = true)
            $this->pay->updateConfirmedAndTransfered($param['pay']);

            // update wallet balance (current balance + topup)
            $this->wallet->topup($_topup->topup); 

            $message = [
                'message' => [
                    'type' => 'success', // bs4 alert class,
                    'title' => 'Top Up Success!',
                    'content' => 'Your top up is success, please check your current balance'
                ],
                
            ];
            
        } catch (Exception $e){
            $message = [
                'message' => [
                    'type' => 'danger', // bs4 alert class,
                    'title' => 'Top Up Failed!',
                    'content' => $e->getMessage()
                ],
            ];
        }

        return $message;
    }

    public function getUniqueCode($length) {
       return $this->unique_code($length);
    }

    // traits
    private function generateTotal($_topup){
        $unique_code = $this->unique_code(3);
        session(['unique_code' => $unique_code]);
        return intval($_topup + $unique_code);
    }

     private function unique_code($length){
        $result = 0;
        
        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        
        return intval($result);
    }


}