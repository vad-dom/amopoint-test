<?php

namespace App\Http\Controllers;

use App\Repositories\VisitRepository;
use Illuminate\View\View;

class StatsController extends Controller
{
    /**
     * @param VisitRepository $visitRepository
     * @return View
     */
    public function index(VisitRepository $visitRepository): View
    {
        return view('stats.index', [
            'visitsByHour' => $visitRepository->getUniqueVisitsByHour(),
            'visitsByCity' => $visitRepository->getVisitsByCity(),
        ]);
    }
}
