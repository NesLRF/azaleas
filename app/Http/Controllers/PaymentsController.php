<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\AnnualFees;
use App\Models\Condomino;
use App\Models\Direcciones;
use App\Models\Monthpayments;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;


class PaymentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function monthly_payments()
    {
        if(Auth::user()->can('condomino_create')){
            Log::info("Puede registrar pagos");
            return view('pages.payment');
        }else{
            return view('errors.error400');
        }
    }

    public function user_import(Request $request)
    {
        if($request->hasFile('document')){
            $path = $request->file('document');
            Excel::import(new UsersImport, $path);

            return back()->withStatus('Terminó la importación');
        }
    }

    public function payment_view()
    {
        if(Auth::user()->can('condomino_create')){
            $condominos = Direcciones::select('id', 'condomino')->get()->toArray();
            $current_month = Carbon::now()->firstOfMonth()->format('m');
            $current_year = Carbon::now()->firstOfMonth()->format('Y');
            
            $index = 0;
            foreach ($condominos as $key => $data) {
                $info[$index++] = [
                    'id' => $data["id"],
                    'text' => $data["condomino"]
                ];
            }

            $info = json_encode($info);

            $current_month = Carbon::now()->format('m');
            $current_month = $current_month."-".Carbon::now()->format('Y');

            $current_year = Carbon::now()->format('Y');

            $last_month = Carbon::now()->startOfMonth()->addMonths(12)->format('m');
            $last_month = $last_month."-".Carbon::now()->startOfMonth()->addMonths(12)->format('Y');

            $fee = AnnualFees::where('year', $current_year)->first();
            $fee = $fee->cuota;

            $current_day = Carbon::now();
            if($current_day < Carbon::now()->firstOfMonth()->addDays(4)){
                $fee = $fee - 100;
            }elseif($current_day > Carbon::now()->firstOfMonth()->addDays(4) && $current_day < Carbon::now()->firstOfMonth()->addDays(9)){
                $fee = $fee - 50;
            }

            if (request('search')) {
                $query = Monthpayments::query();
                $search = request('search');
                $allPayments = $query->when($search, function($query, $search) {
                    return $query->whereHas('direccion', function($query) use ($search) {
                        
                        foreach(Arr::wrap(explode(' ', $search)) as $word)
                        {
                            
                            $query->Where('domicilio', 'LIKE', "%{$word}%")->orWhere('condomino', 'LIKE', "%{$word}%");
                        }
                        
                    });
                })->paginate(10)->setPath ( '' );
                $pagination = $allPayments->appends ( array (
                    'search' => request('search') 
                  ) );

            } else {
                $allPayments = Monthpayments::paginate(10)->setPath ( '' );
            }

            return view('pages.payment_register', compact('info', 'current_month', 'last_month', 'fee', 'allPayments'))->withQuery( $search ?? '' );
        }else{
            return view('errors.error400');
        }
    }

    public function payment_create(Request $request)
    {
        try {
            if(Auth::user()->can('condomino_create')){
                $month_selected = '01-'.$request["month_selected"];
                $month_selected_ff = (new Carbon($month_selected))->format('Y-m-d H:i:s');
                $capture_month = (new Carbon($month_selected_ff))->format('m');
                $capture_year = (new Carbon($month_selected_ff))->format('Y');
                $payment = $request["amount_paid"];
                $description = $request["pay_registered_by"];
                $condomino = Direcciones::find($request["id_selected"]);
                $direccion_id = $condomino->id;
                $check = Monthpayments::where('direccion_id', $direccion_id)->where('capture_month', $capture_month)
                ->where('capture_year', $capture_year)->get();
                $fee = AnnualFees::where('year', Carbon::now()->format('Y'))->first()->cuota;

                if($capture_month > Carbon::now()->startOfMonth()->format('m')){
                    $payment = $fee - 100;
                }
    
                if(count($check) == 0){
                    $payment = Monthpayments::create([
                        "direccion_id" => $direccion_id,
                        "capture_month" => $capture_month,
                        "capture_year" => $capture_year,
                        "paid" => $payment,
                        "description" => $description
                    ]);
                    
                    return back()->with([
                        "status" => "200",
                        "message" => "Pago del condomino ".$condomino->condomino." registrado exitosamente",
                    ]);
                }else{
                    return back()->with([
                        "status" => "400",
                        "message" => "El condomino ".$condomino->condomino." ya realizó el pago del mes ".$request["month_selected"],
                    ]);
                }
                
            }else{
                return view('errors.error400');
            }
        } catch (\Throwable $th) {
            Log::info("Error al registrar pago mensual");
            Log::info($th);
            return back()->with([
                "status" => "500",
                "message" => "Ocurrio un error desconocido, favor de contactar al administrador del sistema",
            ]);
        }
    }

    public function multi_payment_create(Request $request)
    {
        try {
            if(Auth::user()->can('condomino_create')){
                $month_selected = '01-'.$request["month_selected"];
                $month_selected_ff = (new Carbon($month_selected))->format('Y-m-d H:i:s');
                $capture_month = (new Carbon($month_selected_ff))->format('m');
                $capture_year = (new Carbon($month_selected_ff))->format('Y');
                $amount_paid = $request["amount_paid"];
                $description = $request["pay_registered_by"];
                $condomino = Direcciones::find($request["id_selected"]);
                $direccion_id = $condomino->id;
                $check = Monthpayments::where('direccion_id', $direccion_id)->where('capture_month', $capture_month)
                ->where('capture_year', $capture_year)->get();
                $current_year = Carbon::now()->format('Y');
                

                if(count($check) == 0){
                    $payment = Monthpayments::create([
                        "direccion_id" => $direccion_id,
                        "capture_month" => $capture_month,
                        "capture_year" => $capture_year,
                        "paid" => $amount_paid,
                        "description" => $description
                    ]);

                    for ($i=1; $i < $request["total_month"]+1; $i++) { 
                        $capture_month = (new Carbon($month_selected_ff))->addMonths($i)->firstOfMonth();
                        $capture_m = (new Carbon($capture_month))->format('m');
                        $capture_y = (new Carbon($capture_month))->format('Y');
                        $fee = AnnualFees::where('year', $current_year)->first();
                        $fee = $fee->cuota;

                        if(Carbon::now() < (new Carbon($capture_month))->addDays(4)){
                            $fee = $fee - 100;
                        }elseif(Carbon::now() > (new Carbon($capture_month))->addDays(4) && Carbon::now() < (new Carbon($capture_month))->addDays(9)){
                            $fee = $fee - 50;
                        }

                        $payment = Monthpayments::create([
                            "direccion_id" => $direccion_id,
                            "capture_month" => $capture_m,
                            "capture_year" => $capture_y,
                            "paid" => $i == 12 ? 0 : $fee,
                            "description" => $i == 12 ? "Bonificación por anualidad" : $description
                        ]);
                    }
                    
                    
                    return back()->with([
                        "status" => "200",
                        "message" => "Pago del condomino ".$condomino->condomino." registrado exitosamente",
                    ]);
                }else{
                    return back()->with([
                        "status" => "400",
                        "message" => "El condomino ".$condomino->condomino." ya realizó el pago del mes ".$request["month_selected"],
                    ]);
                }
            }else{
                return view('errors.error400');
            }
        } catch (\Throwable $th) {
            Log::info("Error al registrar pago anual");
            Log::info($th);
            return back()->with([
                "status" => "500",
                "message" => "Ocurrio un error desconocido, favor de contactar al administrador del sistema",
            ]);
        }
    }
}
