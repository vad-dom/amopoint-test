<?php

namespace App\Console\Commands;

use App\Services\JokeService;
use Illuminate\Console\Command;
use Throwable;

class FetchRandomJokeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'joke:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch random joke from external API and save it to database';

    /**
     * Execute the console command.
     */
    public function handle(JokeService $jokeService): int
    {
        try {
            $joke = $jokeService->saveApiJokeData();
            $this->info("Joke #{$joke->external_id} saved successfully.");
            return self::SUCCESS;
        } catch (Throwable $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }
    }
}
