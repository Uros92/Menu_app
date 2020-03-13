<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('currencies')->insert([
            'id' => 1,
            'name' => 'Japanese Yen (JPY)',
            'exchange_rate' => 107.17
        ]);
        DB::table('currencies')->insert([
            'id' => 2,
            'name' => 'British Pound (GBP)',
            'exchange_rate' => 0.711178
        ]);
        DB::table('currencies')->insert([
            'id' => 3,
            'name' => 'Euro (EUR)',
            'exchange_rate' => 0.884872,
            'discount' => 2
        ]);
    }
}
