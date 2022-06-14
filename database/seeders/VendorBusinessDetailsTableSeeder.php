<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\vendor_business_details;

class VendorBusinessDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendordetails = [
            [
                'id'=>1, 
                'vendor_id'=>0, 
                'shop_name'=>'Talukder Treders', 
                'shop_address'=>'abrar road', 
                'shop_city'=>'Barisal', 
                'shop_state'=>'Barisal', 
                'shop_country'=>'Bangladesh', 
                'shop_pincode'=>'0147000001', 
                'shop_mobile'=>'012585845268', 
                'shop_website'=>'www.baytul.com', 
                'shop_email'=>'shop.bd@gmail.com', 
                'address_proof'=>'Barisal Sadar', 
                'address_proof_image'=>'', 
                'business_license_number'=>'02369852369', 
                'gst_number'=>'258960000', 
                'pan_number'=>'0178459'
            ],
        ];
        vendor_business_details::insert($vendordetails);
    }
}
