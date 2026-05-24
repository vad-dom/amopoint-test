<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVisitRequest;
use App\Services\VisitService;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;

class VisitController extends Controller
{
    /**
     * @param StoreVisitRequest $request
     * @param VisitService $visitService
     * @return JsonResponse
     * @throws ConnectionException
     */
    public function store(StoreVisitRequest $request, VisitService $visitService): JsonResponse
    {
        $visit = $visitService->store(
            $request->validated(),
            $request->ip(),
            $request->userAgent() ?? ''
        );

        return response()->json([
            'status' => 'success',
            'id' => $visit->id,
        ], 201);
    }
}
