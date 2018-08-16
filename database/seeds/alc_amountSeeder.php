<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class alc_amountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('alc_amount')->insert([
          'kind' => 'beer',
          'how' => 'mug_midium',
          'amount' => 350,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'beer',
          'how' => 'mug_large',
          'amount' => 500,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'beer',
          'how' => 'glass',
          'amount' => 200,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'whiskey',
          'how' => 'single',
          'amount' => 30,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'whiskey',
          'how' => 'double',
          'amount' => 60,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'whiskey',
          'how' => 'soda',
          'amount' => 40,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'whiskey',
          'how' => 'water',
          'amount' => 40,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'wine',
          'how' => 'glass',
          'amount' => 150,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'sake',
          'how' => 'glass',
          'amount' => 180,
        ]);
        DB::table('alc_amount')->insert([
          'kind' => 'sake',
          'how' => 'ichigou',
          'amount' => 180,
        ]);
    }
}
