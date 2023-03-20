<?php

namespace App\Http\Controllers;

use App\Models\Bills;
use App\Models\BillsType;
use Carbon\Carbon;
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
        $bills = Bills::orderBy('created_at','desc')->paginate(10);
        $types = BillsType::select('id','name as text')->get()->toArray();

        $current_month = Carbon::now()->firstOfMonth()->format('m');
        $current_year = Carbon::now()->firstOfMonth()->format('Y');

        $total_fixed = Bills::where('capture_month', $current_month)->where('capture_year', $current_year)->where('bills_type_id', '!=', 11)->get();
        $total_others = Bills::where('capture_month', $current_month)->where('capture_year', $current_year)->where('bills_type_id', 11)->get();
        $total_fixed = count($total_fixed);
        $total_others = count($total_others);

        $types = json_encode($types);
        return view('admin.bills.index', compact('types','bills', 'total_fixed', 'total_others'));
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
            'description' => 'required',
            'month_selected' => 'required'
        ]);

        $month_selected = '01-'.$request["month_selected"];
        $month_selected_ff = (new Carbon($month_selected))->format('Y-m-d H:i:s');
        $capture_month = (new Carbon($month_selected_ff))->format('m');
        $capture_year = (new Carbon($month_selected_ff))->format('Y');

        try{
            $bill = new Bills([
                'bills_type_id' => $request["bills_type_id"],
                'amount' => $request["amount"],
                'description' => $request["description"],
                'capture_year' => $capture_year,
                'capture_month' => $capture_month
            ]);
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
