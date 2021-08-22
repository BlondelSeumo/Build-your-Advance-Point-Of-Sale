<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     Seed the application's database.

     @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);
        $this->call(MasterSeeder::class);
        $this->call(AdminAccountSeeder::class);
        $this->call(ManagerAccountSeeder::class);
        $this->call(PurchaserAccountSeeder::class);
        $this->call(SellerAccountSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(TaxSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(PaymentGatewaySeeder::class);
    }
}
