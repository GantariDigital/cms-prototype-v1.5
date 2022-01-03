<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class KonstruksiUnitRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konstruksi_unit_rumahs')->insert([
            ['name' => 'Type 36', 'slug_name' => Str::slug('Type 36', '-')],
            ['name' => 'Type 45', 'slug_name' => Str::slug('Type 45', '-')],
        ]);
    }
}
