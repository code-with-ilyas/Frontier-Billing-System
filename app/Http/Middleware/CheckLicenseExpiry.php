<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CheckLicenseExpiry
{
    public function handle($request, Closure $next)
    {
        // read expiry date (assumes one row)
        $expiry = DB::table('license')->value('expiry_date');

        if ($expiry && Carbon::now()->gt(Carbon::parse($expiry))) {
            // prevent any further DB interaction for safety
            // (purge the default connection)
            try {
                DB::disconnect();
            } catch (\Throwable $e) {
                // ignore if disconnect is unavailable on some setups
            }

            // If you want JSON API response:
            if ($request->wantsJson() || $request->is('api/*')) {
                return response()->json([
                    'error' => 'Your license expired on ' . $expiry . '. Please contact support.'
                ], 403);
            }

            // For browser requests: return simple HTML (Blade optional)
            $html = "<!doctype html>
                <html><head><meta charset='utf-8'><title>License Expired</title></head>
                <body style='font-family:Arial,sans-serif;background:#f8d7da;color:#721c24;padding:40px;text-align:center;'>
                  <div style='display:inline-block;background:#fff;border:1px solid #f5c6cb;padding:20px;border-radius:8px;'>
                    <h1>⚠️ License Expired</h1>
                    <p>Your license expired on <strong>{$expiry}</strong>.</p>
                    <p>Please contact support to renew access.</p>
                  </div>
                </body></html>";

            return response($html, 403)->header('Content-Type', 'text/html');
        }

        return $next($request);
    }
}
