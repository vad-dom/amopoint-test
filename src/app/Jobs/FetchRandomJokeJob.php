<?php

namespace App\Jobs;

use App\Services\JokeService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;

class FetchRandomJokeJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param JokeService $jokeService
     * @return void
     * @throws ConnectionException
     */
    public function handle(JokeService $jokeService): void
    {
        $jokeService->saveApiJokeData();
    }
}
