<?php

namespace App\Repositories;

use App\Models\Visit;
use Illuminate\Support\Collection;

class VisitRepository
{
    /**
     * @param array $data
     * @return Visit
     */
    public function create(array $data): Visit
    {
        return Visit::create($data);
    }

    /**
     * @return Collection
     */
    public function getUniqueVisitsByHour(): Collection
    {
        return Visit::query()
            ->selectRaw("strftime('%Y-%m-%d %H:00', visited_at) as hour")
            ->selectRaw('COUNT(DISTINCT visitor_hash) as visits_count')
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
    }

    /**
     * @return Collection
     */
    public function getVisitsByCity(): Collection
    {
        return Visit::query()
            ->selectRaw("COALESCE(city, 'Unknown') as city")
            ->selectRaw('COUNT(*) as visits_count')
            ->groupBy('city')
            ->orderByDesc('visits_count')
            ->get();
    }
}
