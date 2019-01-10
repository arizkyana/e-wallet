<?php

namespace Tests\Unit;

use App\Wallet;
use Tests\TestCase;
use App\Repository\Models\WalletRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WalletTest extends TestCase
{
    
    protected $wallet;

    private $_BALANCE = 500000;

    public function setUp(){
        parent::setUp();
        $this->wallet = factory(Wallet::class)->make([
            'id_user' => 1,
            'balance' => $this->_BALANCE
        ]);        
    }


    public function testCannotTopUpWithNegativeValue(){

        $topup = 500000;

        $_wallet = new WalletRepository($this->wallet);

        $_topup = $_wallet->isNegativeTopUp($topup);

        $this->assertFalse($_topup);
        
    }

    public function testTopUpBalance(){

        $topup = 500000;

        $_wallet = new WalletRepository($this->wallet);

        $_topup = $_wallet->_topup($this->wallet->balance, $topup);

        $this->assertSame($_topup, 1000000);

    }

   
}
