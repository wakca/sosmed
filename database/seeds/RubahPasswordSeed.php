<?php

use Illuminate\Database\Seeder;
use App\User;
class RubahPasswordSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(17);
        $user->password = bcrypt('burungnuri');
        $user->save();
    }
}
