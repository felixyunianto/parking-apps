<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parking;
use PDF;

class ParkingController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $parkings = Parking::orderBy('barcode')->get();

        return view('pages.parking.index', compact('parkings'));
    }

    public function create(){
        return view('pages.parking.create');
    }

    public function store(Request $request){
        $rules = [
            'motorcycle_plate' => 'required',
            'driver_name' => 'required',
            'phone_number' => 'required|min:10',
        ];

        $message = [
            'required' => ':attribute ini tidak boleh kosong',
            'min' => ':attribute minimal karakter :min'
        ];

        $this->validate($request, $rules, $message);

        $barcode = date('YmdHis');

        $clockin = date("Y-m-d H:i:s");

        $parking = Parking::create([
            'barcode' => $barcode,
            'motorcycle_plate' => $request->motorcycle_plate,
            'driver_name' => $request->driver_name,
            'phone_number' => $request->phone_number,
            'clockin' => $clockin
        ]);

        return redirect()->route('parking.show', $parking->id)->with('success', 'Data parkir berhasil ditambahkan');

        
    }

    public function show($id){
        $parking = \App\Models\Parking::findOrFail($id);

        return view('pages.parking.show', compact('parking'));
    }

    public function printReceipt($id){
        $parking = \App\Models\Parking::findOrFail($id);

    // $duration = $parking->clockout != null ? round(abs(strtotime($parking->clockout) - strtotime($parking->clockin)) / 60, 2) : 0;

    // if($duration <= 720){
    //     dd("3000");
    // }else{
    //     if($duration <= 1440 && $duration >= 720){
    //         dd("5000");
    //     }else{
    //         $clockin = new \Carbon\Carbon($parking->clockin);
    //     $clockout = new \Carbon\Carbon($parking->clockout);
    //         $diff = \Carbon\Carbon::parse($clockin)->diffInDays($clockout);
    //         dd($diff * (int) "5000");
    //     }
    // }

        // $pdf = \PDF::loadView('barcode.index', compact('parking'))
        // ->setOptions([
        //     'page-width' =>  '58',
        //     'page-height' => '85',
        //     'margin-left' => 0,
        //     'margin-right' => 0,
        //     'margin-top' => 3,
        //     'margin-bottom' => 0
        // ]);
        // dd($pdf);
        
        return view('barcode.index', compact('parking'));
    }
}
