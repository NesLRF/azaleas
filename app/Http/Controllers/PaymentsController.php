<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
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
            $condominos = Direcciones::select('user_id', 'condomino')->get()->toArray();
            $index = 0;
            foreach ($condominos as $key => $data) {
                $info[$index++] = [
                    'id' => $data["user_id"],
                    'text' => $data["condomino"]
                ];
            }

            $info = json_encode($info);

            return view('pages.payment_register', compact('info'));
        }else{
            return view('errors.error400');
        }
    }

    public function payment_create(Request $request)
    {
        if(Auth::user()->can('condomino_create')){
            Log::info($request);
            $month_selected = '01-'.$request["month_selected"];
            $month_selected_ff = (new Carbon($month_selected))->format('Y-m-d H:i:s');
            $capture_month = (new Carbon($month_selected_ff))->format('m');
            $capture_year = (new Carbon($month_selected_ff))->format('Y');
            $payment = $request["amount_paid"];
            $condomino = Direcciones::with('usuario')->where('user_id', $request["id_selected"])->first();
            $user_id = $condomino->usuario->id;
            $check = Monthpayments::where('user_id', $user_id)->where('capture_month', $capture_month)
            ->where('capture_year', $capture_year)->get();

            if(count($check) == 0){
                $payment = Monthpayments::create([
                    "user_id" => $user_id,
                    "capture_month" => $capture_month,
                    "capture_year" => $capture_year,
                    "paid" => $payment
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
    }
}
