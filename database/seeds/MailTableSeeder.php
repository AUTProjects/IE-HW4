<?php

use Illuminate\Database\Seeder;

class MailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($c = 0 ; $c < 100; $c++){
            $int= mt_rand(1262055681,1362055681);
            DB::table('mails')->insert([
            'from' => str_random(10).'@gmail.com',
            'to' => str_random(10).'@gmail.com',
            'text' => str_random(100),
            'title' => str_random(20),
            'created_at' => date("Y-m-d H:i:s",$int),
            'attachment' => '0',
            'read' =>  0,
            'type'=>'send'

        ]);
        }


        for($c = 0 ; $c < 100; $c++){
            $int= mt_rand(1262055681,1362055681);
            DB::table('mails')->insert([
                'from' => str_random(10).'@gmail.com',
                'to' => str_random(10).'@gmail.com',
                'text' => str_random(100),
                'title' => str_random(20),
                'attachment' => '0',
                'read' =>  0,
                'created_at' => date("Y-m-d H:i:s",$int),
                'type'=>'receive'
            ]);
        }
    }
}
