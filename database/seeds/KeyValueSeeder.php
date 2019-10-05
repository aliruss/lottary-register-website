<?php

use App\KeyValue;
use Illuminate\Database\Seeder;

class KeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KeyValue::set('app.name', 'App Name');
    }
}
