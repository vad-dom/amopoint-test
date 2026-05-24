<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class JokeApiService
{
    private const API_URL = 'https://official-joke-api.appspot.com/random_joke';

    /**
     * @return array
     * @throws ConnectionException
     */
    public function fetchRandomJoke(): array
    {
        $response = Http::timeout(10)->get(self::API_URL);
        if (!$response->successful()) {
            throw new RuntimeException('Failed to fetch joke from API');
        }
        return $response->json();
    }
}
