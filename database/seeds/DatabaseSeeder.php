<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTablesSeeder::class);
         $this->call(UsersSeeder::class);
         $this->call(CategoriesSeeder::class);
         $this->call(ProductsSeeder::class);
         $this->call(UserAddressesSeeder::class);
         $this->call(CouponCodeSeeder::class);
         $this->call(OrdersSeeder::class);
         $this->call(SolidersSeeder::class);
    }
}