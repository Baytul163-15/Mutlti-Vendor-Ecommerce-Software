<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id'=>3,'name'=>'Raihan','type'=>'admin','vendor_id'=>0,'mobile'=>'01765513668','email'=>'raihan@gmail.com','password'=>'$2a$12$tURGC0EBxKKqmO6JufSA2uCMtMt1FIny2XKUoHqBwJhPJi2GVa.z2','image'=>'','status'=>0],
        ];
        Admin::insert($adminRecords);
    }
}
