<?php

namespace App\Services;

use App\Models\Joke;
use App\Repositories\JokeRepository;
use Illuminate\Http\Client\ConnectionException;

readonly class JokeService
{
    /**
     * @param JokeApiService $jokeApiService
     * @param JokeRepository $jokeRepository
     */
    public function __construct(
        private JokeApiService $jokeApiService,
        private JokeRepository $jokeRepository,
    ) {
    }

    /**
     * @return Joke
     * @throws ConnectionException
     */
    public function saveApiJokeData(): Joke
    {
        $data = $this->jokeApiService->fetchRandomJoke();
        return $this->jokeRepository->saveData($data);
    }
}
