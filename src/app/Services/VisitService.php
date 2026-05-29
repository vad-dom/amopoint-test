<?php

namespace App\Services;

use App\Jobs\ProcessVisitJob;
use App\Models\Visit;
use App\Repositories\VisitRepository;
use Illuminate\Support\Carbon;

readonly class VisitService
{
    public function __construct(
        private VisitRepository $visitRepository,
    ) {
    }

    /**
     * @param array $validatedData
     * @param string $ip
     * @param string $userAgent
     * @return Visit
     */
    public function store(array $validatedData, string $ip, string $userAgent): Visit
    {
        $visitorHash = sha1(
            $ip
            . $userAgent
            . Carbon::now()->format('Y-m-d')
        );

        $visit = $this->visitRepository->create([
            'visitor_hash' => $visitorHash,
            'ip' => $ip,
            'user_agent' => $userAgent,
            'page_url' => $validatedData['page_url'] ?? null,
            'referer' => $validatedData['referer'] ?? null,
            'visited_at' => now(),
        ]);

        ProcessVisitJob::dispatch($visit->id);

        return $visit;
    }
}
