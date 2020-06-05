<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        DB::table("users")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
        User::create([
            'name' => "GamerSocial",
            'email' => "gamersocialverified@gmail.com",
            'real_name'=> "GamerSocial",
            'last_name'=>"GamerSocial",
            "img"=> "img/app/icons/iconBlue.svg",
            'role_id'=> 1,
            'password' => Hash::make("12345678"),
            "email_verified_at" => now()
        ]);
    }
}