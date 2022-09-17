<?php

use Illuminate\Database\Seeder;

class PostsData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('posts')->delete();

        for($i = 1; $i < 5; $i++){
            $data[] =
            [
                'user_id' => 1,
                'body' => "${i}テストデータ",
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
    
        DB::table('posts')->insert($data);
    }
}
