<?php

namespace App\Services;

use App\Models\Visit;
use App\Repositories\VisitRepository;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Carbon;
use Jenssegers\Agent\Agent;

readonly class VisitService
{
    public function __construct(
        private GeoIpService    $geoIpService,
        private VisitRepository $visitRepository,
    ) {
    }

    /**
     * @param array $validatedData
     * @param string $ip
     * @param string $userAgent
     * @return Visit
     * @throws ConnectionException
     */
    public function store(array $validatedData, string $ip, string $userAgent): Visit
    {
        $agent = new Agent();
        $agent->setUserAgent($userAgent);

        $geoData = $this->geoIpService->resolve($ip);

        $visitorHash = sha1(
            $ip
            . $userAgent
            . Carbon::now()->format('Y-m-d')
        );

        return $this->visitRepository->create([
            'visitor_hash' => $visitorHash,

            'ip' => $ip,

            'city' => $geoData['city'],
            'country' => $geoData['country'],

            'device' => $agent->device() ?: 'Desktop',
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),

            'user_agent' => $userAgent,

            'page_url' => $validatedData['page_url'] ?? null,
            'referer' => $validatedData['referer'] ?? null,

            'visited_at' => now(),
        ]);
    }
}
