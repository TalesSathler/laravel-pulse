<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class SimulateExceptionJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(
        public string $message = 'Simulated exception from SimulateExceptionJob',
    ) {
        $this->onQueue('simulate');
    }

    public function handle(): void
    {
        Log::warning('SimulateExceptionJob about to throw', [
            'message' => $this->message,
        ]);

        throw new \RuntimeException($this->message);
    }
}
