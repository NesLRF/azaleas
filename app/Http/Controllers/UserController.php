<?php

namespace App\Http\Controllers;

use App\Models\Direcciones;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{

    public $columns = [
        'name', 'email', 'last_name'

    ];
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



            if (request('search')) {
                $query = User::query();
                $search = request('search');
                $users = $query->when($search, function($query, $search) {
                    return $query->where(function($query) use ($search) {
                        foreach($this->columns as $column)
                        {
                            foreach(Arr::wrap(explode(' ', $search)) as $word)
                            {
                                $query->orWhere($column, 'LIKE', "%{$word}%");
                            }
                        }
                    });
                })->paginate(10)->setPath ( '' );

                $pagination = $users->appends ( array (
                    'search' => request('search') 
                  ) );

            } else {
                $users = User::orderBy('created_at','desc')->paginate(10)->setPath ( '' );
            }
            

            return view('admin.users.create', compact('info','users'))->withQuery( $search ?? '' );
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
