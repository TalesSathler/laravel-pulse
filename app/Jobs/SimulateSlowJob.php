<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SimulateSlowJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct()
    {
        $this->onQueue('simulate');
    }

    public function handle(): void
    {
        $duration = rand(15, 30) / 10;

        DB::select('SELECT pg_sleep(?)', [$duration]);

        DB::table('migrations')->count();

        Log::info('SimulateSlowJob processed', [
            'duration' => $duration,
            'time' => now()->toDateTimeString(),
        ]);
    }
}
