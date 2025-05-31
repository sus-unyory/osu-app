<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OsuApiService
{
    private $clientId;
    private $clientSecret;
    private $token;

    public function __construct()
    {
        $this->clientId = config('osu.client_id');
        $this->clientSecret = config('osu.client_secret');
        $this->token = $this->getAccessToken();
    }

    private function getAccessToken()
    {
        $response = Http::post('https://osu.ppy.sh/oauth/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'grant_type' => 'client_credentials',
            'scope' => 'public',
        ]);

        return $response->json()['access_token'];
    }

    public function getBCount(string $username)
    {
        $response = Http::withToken($this->token)
            ->get("https://osu.ppy.sh/api/v2/users/{$username}/scores/recent", [
                'limit' => 100,
            ]);

        if (!$response->ok()) {
            return null;
        }

        $scores = $response->json();

        return collect($scores)->where('rank', 'B')->count();
    }

    public function getUser(string $username)
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)
            ->get("https://osu.ppy.sh/api/v2/users/{$username}");

        if ($response->successful()) {
            return $response->json();
        }

        // エラー時は null または例外を返すのもあり
        return null;
    }


}
