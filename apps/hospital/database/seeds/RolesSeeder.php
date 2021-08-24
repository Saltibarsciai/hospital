<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        DB::table('roles')->truncate();

        DB::table('roles')->insert([
            'name' => 'receptionist',
        ]);
        DB::table('roles')->insert([
            'name' => 'doctor',
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
