<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        // $this->call(AdminsTableSeeder::class);
        // $this->call(VendorTableSeeder::class);
        // $this->call(VendorBusinessDetailsTableSeeder::class);
        // $this->call(VendorBankDetailsTableSeeder::class);
        // $this->call(SectionTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(BrandTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        $this->call(ProductAttributeTableSeeder::class);
    }
}
