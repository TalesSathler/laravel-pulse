<?php

namespace App\Http\Controllers;

use App\Jobs\SimulateExceptionJob;
use App\Jobs\SimulateSlowJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SimulateController extends Controller
{
    public function slowRequest()
    {
        $duration = (float) request('duration', 2);

        usleep($duration * 1_000_000);

        DB::select('SELECT pg_sleep(?)', [$duration * 0.5]);

        return response()->json([
            'message' => "Simulated slow request lasting {$duration}s",
        ]);
    }

    public function exception()
    {
        throw new \RuntimeException('Simulated exception from '.__METHOD__);
    }

    public function dispatch(Request $request)
    {
        $type = $request->input('type');

        match ($type) {
            'slow-job' => SimulateSlowJob::dispatch(),
            'exception' => SimulateExceptionJob::dispatch(),
            'slow-query' => DB::select('SELECT pg_sleep(2)'),
            'slow-outgoing' => Http::timeout(30)->get(env('PULSE_SIMULATE_URL', config('app.url')).'/simulate/slow-response'),
            'slow-request' => usleep(2_500_000),
            default => throw new \InvalidArgumentException("Unknown simulation type: {$type}"),
        };

        return redirect()->back()->with('success', "Simulation '{$type}' completed successfully!");
    }
}
