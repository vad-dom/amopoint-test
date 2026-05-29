<?php

namespace App\Console\Commands;

use App\Jobs\FetchRandomJokeJob;
use Illuminate\Console\Command;

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
    protected $description = 'Dispatch job to fetch random joke from external API and save it to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        FetchRandomJokeJob::dispatch();
        $this->info('Fetch random joke job dispatched.');
        return self::SUCCESS;
    }
}
