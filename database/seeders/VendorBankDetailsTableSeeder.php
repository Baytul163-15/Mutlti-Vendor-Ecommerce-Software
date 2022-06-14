<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\vendor_bank_details;

class VendorBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBankDetails = [
            [
                'id'=>1, 
                'vendor_id'=>0, 
                'account_holder_name'=>'Baytul Hossen Talukder', 
                'bank_name'=>'Sonali Bank', 
                'account_number'=>'01756326985', 
                'bank_ifac_code'=>'0147852'
            ],
        ];
        vendor_bank_details::insert($vendorBankDetails);
    }
}
