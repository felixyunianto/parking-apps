<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use App\Models\Slot;

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

        $space = Slot::findOrFail(1)->capasity;
        
        $ongoing = Parking::where('clockout', null)->count();

        $empty = $space - $ongoing;
        
        return view('pages.home', compact('space', 'ongoing', 'empty'));
    }

    public function chartMontly(Request $request) {
        $months = (array) [
            "Jan" => 0,
            "Feb" => 0,
            "Maret" => 0,
            "Apr" => 0,
            "Mei" => 0,
            "Juni" => 0,
            "Juli" => 0,
            "Aug" => 0,
            "Sep" => 0,
            "Okt" => 0,
            "Nov" => 0,
            "Des" => 0,

        ];
        $monthData = Parking::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count', 'month_name');

        foreach($monthData as $index => $m){
            $months[$index] = $m;
        }
        
        return response()->json([
            // 'label' => $labels,
            'data' => (array) $months
        ]);
    }

    public function chartWeekly(Request $request){

        $weeks = (array) [
            "Minggu 1" => 0,
            "Minggu 2" => 0,
            "Minggu 3" => 0,
            "Minggu 4" => 0
        ];


        $weekData = Parking::select(
            \DB::raw("WEEK(clockin) as week"),
            \DB::raw("COUNT(clockin) as total"),
        )
        ->groupBy('week')
        ->orderBy('week', 'ASC')
        ->get();

        foreach($weekData as $index => $w){
            $weeks["Minggu ".((int)$index + 1)] =  intval($w->total);
        }

        return response()->json([
            // 'label' => $labels,
            'data' => (array) $weeks
        ]);
    
    }
}
