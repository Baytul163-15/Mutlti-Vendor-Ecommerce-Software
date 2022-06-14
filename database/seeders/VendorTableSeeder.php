<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            ['id'=>3, 'name'=>'kona', 'address'=>'CPCA-102', 'city'=>'Barisal', 'state'=>'Khulna', 'country'=>'Bangladesh', 'pincode'=>'112584', 'mobile'=>'01765513667', 'email'=>'kona@gmail.com', 'password'=>'$2a$12$tURGC0EBxKKqmO6JufSA2uCMtMt1FIny2XKUoHqBwJhPJi2GVa.z2', 'status'=>1],
        ];
        Vendor::insert($vendorRecords);
    }
}
