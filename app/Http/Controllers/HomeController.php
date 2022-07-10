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

    public function chartMontly(Request $request) {
        $months = (array) [
            "January" => 0,
            "February" => 0,
            "March" => 0,
            "April" => 0,
            "May" => 0,
            "June" => 0,
            "July" => 0,
            "August" => 0,
            "September" => 0,
            "October" => 0,
            "November" => 0,
            "December" => 0,

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
            $weeks["Minggu ".$index+1] =  intval($w->total);
        }

        return response()->json([
            // 'label' => $labels,
            'data' => (array) $weeks
        ]);
    
    }
}
