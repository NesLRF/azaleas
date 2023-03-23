<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        if(in_array( Auth::user()->getRoleNames()->first(),['Admin','SuperAdmin'])){
            $current_month = Carbon::now()->startOfMonth()->format('M');
            $current_month_year = Carbon::now()->startOfMonth()->format('Y');
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha = Carbon::parse($current_month);
            $mes = $meses[($fecha->format('n')) - 1];
            $months =  [
                "current_month" => $mes,
                "current_month_year" => $current_month_year 
            ];
            
                $total_users = User::with('roles')->get();
                foreach ($total_users as $user) {
                    if($user->roles->first()->name == 'Vecino'){
                        $total_neighbors[] = [
                            $user->roles->first()->name
                        ];
                    }
                }
                $total_neighbors = count($total_neighbors);
                // $total_users = $total_users->roles->where('name', 'Vecino');
                $total_users = count($total_users);
            
            return view('admin.home.home', compact('months', 'total_neighbors'));
        }else{
            return view('errors.error400');
        }
    }
}
