<?php

use Illuminate\Database\Seeder;

class DrinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('drinks')->insert([
          'kind' => 'beer',
          'kindDisp' => 'ビール',
          'how' => 'mug_midium',
          'howDisp'=> '中ジョッキ',
          'amount' => 350,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'beer',
          'kindDisp' => 'ビール',
          'how' => 'mug_large',
          'howDisp'=> '大ジョッキ',
          'amount' => 500,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'beer',
          'kindDisp' => 'ビール',
          'how' => 'glass',
          'howDisp'=> 'グラス',
          'amount' => 200,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'whiskey',
          'kindDisp' => 'ウィスキー',
          'how' => 'rock',
          'howDisp' => 'ロック',
          'amount' => 60,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'whiskey',
          'kindDisp' => 'ウィスキー',
          'how' => 'soda',
          'howDisp' => 'ハイボール',
          'amount' => 60,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'whiskey',
          'kindDisp' => 'ウィスキー',
          'how' => 'water',
          'howDisp' => '水割り',
          'amount' => 40,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'wine',
          'kindDisp' => 'ワイン',
          'how' => 'glass',
          'howDisp' => 'グラス',
          'amount' => 150,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'sake',
          'kindDisp' => '日本酒',
          'how' => 'glass',
          'howDisp' => 'グラス',
          'amount' => 180,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'sake',
          'kindDisp' => '日本酒',
          'how' => 'ichigou',
          'howDisp' => '一合',
          'amount' => 180,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'shochu',
          'kindDisp' => '焼酎',
          'how' => 'rock',
          'howDisp' => 'ロック',
          'amount' => 100,
        ]);
        DB::table('drinks')->insert([
          'kind' => 'shochu',
          'kindDisp' => '焼酎',
          'how' => 'water',
          'howDisp' => '水割り',
          'amount' => 100,
        ]);
    }
}
