<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = factory(App\User::class)->create([
            'name' => 'Handsome Jin',
            'email' => 'tiramisujin@gmail.com',
            'password' => bcrypt('secret')
        ]);

        $user = factory(App\User::class)->create([
            'name' => 'Esp',
            'email' => 'eng@linkbrick.com',
            'password' => bcrypt('secret')
        ]);

        $user = factory(App\User::class)->create([
            'name' => 'Chong',
            'email' => 'ckangwei83@gmail.com',
            'password' => bcrypt('secret')
        ]);


    }
}
