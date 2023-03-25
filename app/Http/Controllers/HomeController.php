<?php

namespace App\Http\Controllers;

use App\Models\AnnualFees;
use App\Models\Direcciones;
use App\Models\Monthpayments;
use App\Models\User;
use App\Models\Visits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use NumberFormatter;

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
            $total_users = count($total_users);

            $condominos = Direcciones::all();
            $condominos_count = $condominos->count();

            $fee = AnnualFees::where('year', $current_month_year)->first()->cuota;

            $total = $condominos_count * $fee;

            $total_money_annual = $total * 12;

            $total_mensual = number_format($total, 0, ',');

            $total_annual = number_format($total_money_annual, 0, ',');

            $annual_payments = Monthpayments::where('capture_year', $current_month_year)->where('paid', '!=', 0)->pluck('paid');
            $month_payments = Monthpayments::where('capture_month', Carbon::now()->startOfMonth()->format('m'))->where('capture_year', $current_month_year)->where('paid', '!=', 0)->pluck('paid');
            $month_payments_count = $month_payments->count();
            $total_current_year = array_sum($annual_payments->toArray());
            $total_current_year_format = number_format($total_current_year, 0, ',');
            $total_current_month = array_sum($month_payments->toArray());
            $total_current_month_format = number_format($total_current_month, 0, ',');

            $total_current_month_percent = ($total_current_month / $total) * 100;
            $total_current_month_percent_format = round($total_current_month_percent, 1);

            $total_annual_percent = ($total_current_year / $total_money_annual) * 100;

            $total_annual_percent_format = round($total_annual_percent, 1);

            $start_of_year = Carbon::now()->startOfYear()->format('Y-m-d H:i:s');
            $end_of_year = Carbon::now()->endOfYear()->format('Y-m-d H:i:s');

            $visits = Visits::whereBetween('created_at', [$start_of_year, $end_of_year]);
            $visits_count = $visits->count();

            return view('admin.home.home', compact(
                'months',
                'total_neighbors',
                'total_mensual',
                'fee',
                'total_annual',
                'month_payments_count',
                'total_current_month_format',
                'total_current_month_percent_format',
                'total_current_year_format',
                'total_annual_percent_format',
                'visits_count'
            ));
        }else{
            return view('errors.error400');
        }
    }
}
