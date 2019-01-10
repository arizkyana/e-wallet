<?php

namespace Tests\Unit;

use App\Wallet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WalletTest extends TestCase
{
    
    protected $wallet;

    private $_BALANCE = 500000;

    public function testUpdateBalanceEqualValue()
    {
        $topup = 500000;

        $wallet = factory(Wallet::class)->make([
            'id_user' => 1,
            'balance' => $this->_BALANCE
        ]);

        $this->assertTrue($wallet->balance == $topup);
        $this->assertFalse($wallet->balance == $topup);

        $this->assertSame($wallet->balance, $topup);
        $this->assertEqual($wallet->balance, $topup);
    }

    public function testUpdateBalanceLowerThanCurrent(){

        $topup = 500000;

        $wallet = factory(Wallet::class)->make([
            'id_user' => 1,
            'balance' => $this->_BALANCE
        ]);

        $this->assertTrue($wallet->balance < $topup);
        $this->assertFalse($wallet->balance < $topup);
    }

    public function testUpdateBalanceHigherThanCurrent(){

        $topup = 500000;

        $wallet = factory(Wallet::class)->make([
            'id_user' => 1,
            'balance' => $this->_BALANCE
        ]);

        $this->assertTrue($wallet->balance > $topup);
        $this->assertFalse($wallet->balance > $topup);

    }

    public function testUpdateBalanceZeroValue(){

        $topup = 0;

        $wallet = factory(Wallet::class)->make([
            'id_user' => 1,
            'balance' => $this->_BALANCE
        ]);

        $this->assertSame($wallet->balance, ($wallet->balance + $topup));

    }

    // public function testUpdateBalanceMinValue(){
        
    //     $topup = -100000;

        
    // }
}
