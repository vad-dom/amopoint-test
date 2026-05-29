<?php

namespace App\Jobs;

use App\Models\Visit;
use App\Services\GeoIpService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use Jenssegers\Agent\Agent;

class ProcessVisitJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly int $visitId)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param GeoIpService $geoIpService
     * @return void
     * @throws ConnectionException
     */
    public function handle(GeoIpService $geoIpService): void
    {
        $visit = Visit::find($this->visitId);

        if (!$visit) {
            return;
        }

        $geoData = $geoIpService->resolve($visit->ip);

        $agent = new Agent();
        $agent->setUserAgent($visit->user_agent ?? '');

        $visit->update([
            'city' => $geoData['city'],
            'country' => $geoData['country'],
            'device' => $agent->device() ?: 'Desktop',
            'browser' => $agent->browser(),
            'platform' => $agent->platform(),
        ]);
    }
}
