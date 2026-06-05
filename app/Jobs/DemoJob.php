<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DemoJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->onQueue('demo');
    }

    public function handle(): void
    {
        DB::select('SELECT pg_sleep(?)', [rand(1, 3) / 10]);

        DB::table('migrations')->count();

        DB::select('SELECT pg_sleep(?)', [rand(1, 3) / 10]);

        DB::table('users')->where('id', rand(1, 100))->value('name');

        Log::info('DemoJob processed successfully', [
            'time' => now()->toDateTimeString(),
        ]);
    }
}
