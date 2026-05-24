<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\JokeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JokeController extends Controller
{
    /**
     * @param Request $request
     * @param JokeRepository $jokeRepository
     * @return JsonResponse
     */
    public function index(Request $request, JokeRepository $jokeRepository): JsonResponse
    {
        $limit = (int) $request->query('limit', 20);
        $jokes = $jokeRepository->getLatest($limit);
        return response()->json($jokes);
    }}
