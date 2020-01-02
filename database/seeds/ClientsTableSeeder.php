<?php

use App\Models\Client;
use App\Models\SoccerTeam;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Client::class, 100)->states(Client::TYPE_LEGAL)->create();
        // factory(Client::class, 100)->states(Client::TYPE_INDIVIDUAL)->create();

        $soccers = SoccerTeam::all();
        $collectionIndividual = factory(Client::class, 5)->states(Client::TYPE_INDIVIDUAL)->make();
        $collectionIndividual->each(function ($client) use ($soccers) {
            $client->soccer_team_id = $soccers->random()->id;
            $client->save();
        });
        $collectionLegal = factory(Client::class, 5)->states(Client::TYPE_LEGAL)->make();
        $collectionLegal->each(function ($client) use ($soccers) {
            $client->soccer_team_id = $soccers->random()->id;
            $client->save();
        });
    }
}
