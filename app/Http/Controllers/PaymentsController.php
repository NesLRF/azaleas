<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Direcciones;
use App\Models\User;
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
        Log::info("Import");
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
            Log::info("All request");
            Log::info($request);
            Log::info("Id seleccionado: " .$request["id_selected"]);

            $condomino = Direcciones::where('user_id', $request["id_selected"])->with('usuario')->get();

            $user = User::find($request["id_selected"]);

            Log::info("Datos");
            Log::info($condomino);
            Log::info("User");
            Log::info($user);

            return back()->withStatus('Registro exitoso');
        }else{
            return view('errors.error400');
        }
    }
}
