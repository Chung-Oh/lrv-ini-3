<?php

use App\Models\SoccerTeam;
use Illuminate\Database\Seeder;

class SoccerTeamsTableSeeder extends Seeder
{
    const MAX_ROWS = 5;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(SoccerTeam::class, self::MAX_ROWS)->create();
    }
}
