<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\BillsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bills::all();
        $types = BillsType::select('id','name as text')->get()->toArray();
        $types = json_encode($types);
        return view('admin.bills.index', compact('types','bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'bills_type_id' => 'required',
            'amount' => 'required|integer',
            'description' => 'nullable'
        ]);
        try{
            $bill = new Bills();
            $bill->fill($request->all());
            $bill->save(); 

            return back()->with([
                "status" => "200",
                "message" => "Gasto registrado exitosamente",
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
