<?php

namespace App\Http\Controllers;

use App\Models\Direcciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

            $users = User::orderBy('created_at','desc')->paginate(10);

            return view('admin.users.create', compact('info','users'));
        }else{
            return view('errors.error400');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users'
        ]);
        try{
            $condomino = Direcciones::find($request->condomino_id);
            $coincidencia = false;
            switch($request->status){
                case 'tenant':
                    $coincidencia = count($condomino->tenant)>0 ? true : false;
                    $type = 'rents';
                    break;
                case 'owner':
                    $coincidencia = count($condomino->owner)>0 ? true : false;
                    $type = 'properties';
                    break;
            }
    
            if($coincidencia){
                return back()->with([
                    "status" => "400",
                    "message" => "El condomino ".$condomino->condomino." ya tiene registrado un ". ($request->status == 'tenant' ? 'inquilino':'dueño' ),
                ])->withInput();
            }
            $request["password"] = Hash::make($request['password']);
    
            $user = new User();
            $user->fill($request->all())->save();
            if(isset($type)){
                $user->$type()->attach($request->condomino_id);

                $user->assignRole('Vecino');
            }else{
                $user->assignRole('Guardia');
            }
           
    
            return back()->with([
                "status" => "200",
                "message" => "Usuario registrado exitosamente",
            ]);
        }catch(\Exception $e){
            Log::info($e);
            return back()->with([
                "status" => "500",
                "message" => "Ocurrio un error desconocido",
            ]);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
