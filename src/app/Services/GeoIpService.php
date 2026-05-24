<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class GeoIpService
{
    private const API_URL = 'http://ip-api.com/json/';

    /**
     * @param string $ip
     * @return array|null[]
     * @throws ConnectionException
     */
    public function resolve(string $ip): array
    {
        $response = Http::timeout(5)
            ->get(self::API_URL . $ip);

        if (!$response->successful()) {
            return [
                'city' => null,
                'country' => null,
            ];
        }

        $data = $response->json();

        return [
            'city' => $data['city'] ?? null,
            'country' => $data['country'] ?? null,
        ];
    }
}
