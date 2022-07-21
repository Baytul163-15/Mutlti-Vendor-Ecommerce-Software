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
            ['id'=>4,'name'=>'Hossen Khan','type'=>'superadmin','vendor_id'=>2,'mobile'=>'01765513668','email'=>'hossen@gmail.com','password'=>'$2a$12$tURGC0EBxKKqmO6JufSA2uCMtMt1FIny2XKUoHqBwJhPJi2GVa.z2','image'=>'','status'=>0],
        ];
        Admin::insert($adminRecords);
    }
}
