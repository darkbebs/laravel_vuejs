<?php

use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Dark\Models\User::class)->create([
            'email' => 'big.dark@gmail.com'
        ]);
    }
}
