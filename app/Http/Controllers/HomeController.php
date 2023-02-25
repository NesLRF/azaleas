<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        $current_month = Carbon::now()->startOfMonth()->format('M');
        $current_month_year = Carbon::now()->startOfMonth()->format('Y');
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($current_month);
        $mes = $meses[($fecha->format('n')) - 1];
        $months =  [
            "current_month" => $mes,
            "current_month_year" => $current_month_year 
        ];
        Log::info($mes);
        if(Auth::user()->can('user_create')){
            Log::info("Es Admin o SuperAdmin");
        }
        return view('pages.home', compact('months'));
    }
}
