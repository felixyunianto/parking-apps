<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home');
    }

    public function getChartData(Request $request) {
        // $data = Parking::
        $now = \Carbon\Carbon::now();
        $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i:s');
        $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i:s');

        $weeklyVisitors = \DB::table('parkings')
        ->select([
            \DB::raw('DATE_FORMAT(clockin,"%Y-%m-%d") as date'),
            \DB::raw('count(DATE_FORMAT(clockin,"%Y-%m-%d")) as total'),
        ])
        ->whereBetween('clockin', [$weekStartDate, $weekEndDate])
        ->groupBy('date')
        ->get();
        
        return response()->json($weeklyVisitors);
    }
}
