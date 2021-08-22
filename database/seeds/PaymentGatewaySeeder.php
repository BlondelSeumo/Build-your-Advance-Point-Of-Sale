<?php

use App\Payment;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Payment::count() === 0) {
            Payment::create(
                [
                    'title'  => 'Cash Payment',
                    'code'   => 'cash001',
                    'state'  => 1,
                    'detail' => 'Cash Payment (Update Description)'
                ]
            );
            Payment::create(
                [
                    'title'  => 'Via Card',
                    'code'   => 'via-card',
                    'state'  => 1,
                    'detail' => 'Card Payment (Update Description)'
                ]
            );
        }
    }
}
