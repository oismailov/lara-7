<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class PlaneTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('plane_types')->delete();

        DB::table('plane_types')->insert([
                [
                    'id' => 1,
                    'name' => 'short_range',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]
        );
    }
}
