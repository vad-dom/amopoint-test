<?php

namespace App\Repositories;

use App\Models\Joke;
use Illuminate\Database\Eloquent\Collection;

class JokeRepository
{
    /**
     * @param array $data
     * @return Joke
     */
    public function saveData(array $data): Joke
    {
        return Joke::updateOrCreate(
            [
                'external_id' => $data['id'],
            ],
            [
                'type' => $data['type'],
                'setup' => $data['setup'],
                'punchline' => $data['punchline'],
            ]
        );
    }

    /**
     * @param int $limit
     * @return Collection
     */
    public function getLatest(int $limit = 20): Collection
    {
        return Joke::query()
            ->latest()
            ->limit($limit)
            ->get();
    }
}
