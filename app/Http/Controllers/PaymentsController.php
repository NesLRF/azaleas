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

            Log::info("Año de cuota");
            Log::info($fee);

            return view('pages.payment_register', compact('info', 'current_month', 'last_month'));
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
                Log::info("Pago anual");
                Log::info($request);
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

                if(count($check) == 0){
                    $payment = Monthpayments::create([
                        "direccion_id" => $direccion_id,
                        "capture_month" => $capture_month,
                        "capture_year" => $capture_year,
                        "paid" => 300,
                        "description" => $description
                    ]);

                    for ($i=1; $i < 13; $i++) { 
                        $capture_month = (new Carbon($month_selected_ff))->addMonths($i)->format('m');
                        $capture_year = (new Carbon($month_selected_ff))->addMonths($i)->format('Y');

                        $payment = Monthpayments::create([
                            "direccion_id" => $direccion_id,
                            "capture_month" => $capture_month,
                            "capture_year" => $capture_year,
                            "paid" => $i == 12 ? 0 : 300,
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
