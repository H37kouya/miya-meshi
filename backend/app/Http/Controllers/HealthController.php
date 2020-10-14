<?php

namespace App\Http\Controllers;

class HealthController extends Controller
{
    /**
     * Health Check用
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return response()->json('ok');
    }
}
