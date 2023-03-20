<?php

namespace App\Http\Controllers;

use App\Models\Direcciones;
use App\Models\Visits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits = Visits::orderBy('created_at','desc')->paginate(10);
        return view('admin.visits.index', compact('visits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $direcciones = Direcciones::select('id','domicilio')->get()->toArray();
        $index = 0;
        $info = [];
        foreach ($direcciones as $key => $data) {
            
            $info[$index++] = [
                'id' => $data["id"],
                'text' => $data["domicilio"].check_payment($data["id"])
            ];
        }
        $direcciones = json_encode($info);
        return view('guard.visits.create',compact('direcciones'));
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
            'visit_to' => 'required',
            'name' => 'required',
            'plates' => 'required'
        ]);

        try{
            $visit = new Visits();
            $visit['registered_by'] = Auth::user()->id;
            $visit->fill($request->all())->save();

            return back()->with([
                "status" => "200",
                "message" => "Visita registrada exitosamente",
            ]);

        }
        catch(\Exception $e){
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
