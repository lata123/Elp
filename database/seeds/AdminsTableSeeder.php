<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'phone_code'=>'91',
            'phone_number'=>'9876543216',
            'citizen_id' => '123456',
            'billing_id' => '123456',
            'reference_no' => '123456',
            'department' => 'test',
            'position' => 'test',
            'role_id' => '0',
            'status' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
