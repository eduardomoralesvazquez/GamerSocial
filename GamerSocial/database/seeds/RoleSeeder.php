<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0;");
        DB::table("roles")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS = 1;");
        Role::create([
            "name"=>"administrator",
            "description"=>"This role has administrative power on the website",
        ]);
        Role::create([
            "name"=>"moderator",
            "description"=>"This role can delete third party posts or other contents",
        ]);
        Role::create([
            "name"=>"hight_user",
            "description"=>"This role has intermediate powers, usually dev and publisher",
        ]);
        Role::create([
            "name"=>"standart",
            "description"=>"This role has normal user power",
        ]);
    }
}
