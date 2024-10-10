<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Rocket;
use Illuminate\Http\Request;

class RocketController extends Controller
{
    public function fetchAndStoreRockets()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.spacexdata.com/v4/rockets');
        $rockets = json_decode($response->getBody(), true);

        foreach ($rockets as $rocketData) {
            Rocket::create([
                'rocket_id' => $rocketData['id'],
                'rocket_name' => $rocketData['name'],
                'active' => $rocketData['active'],
                // Diğer alanlar...
            ]);
        }

        return response()->json(['message' => 'Rockets fetched and stored successfully']);
    }
}
