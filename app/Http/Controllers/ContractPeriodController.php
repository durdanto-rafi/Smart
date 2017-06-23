<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MstContractPeriod;

class contractPeriodController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contractPeriods = MstContractPeriod::orderBy('contract_period_number','ASC')->paginate(20);
        return view('contractPeriod.index',compact('contractPeriods'))->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contractPeriod.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'contract_period_name' => 'required',
        ]);
        $contractPeriod = MstContractPeriod::orderBy('contract_period_number', 'desc')->first();

        MstContractPeriod::create(array_merge(['contract_period_number' => $contractPeriod == null ? 0 : ($contractPeriod->contract_period_number) + 1], $request->all()));
        return redirect()->route('contractPeriod.index')->with('success','contractPeriod created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $contract_period_number
     * @return \Illuminate\Http\Response
     */
    public function show($contract_period_number)
    {
        $contractPeriod = MstContractPeriod::find($contract_period_number);
        return view('contractPeriod.show',compact('contractPeriod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $contract_period_number
     * @return \Illuminate\Http\Response
     */
    public function edit($contract_period_number)
    {
        $contractPeriod = MstContractPeriod::find($contract_period_number);
        return view('contractPeriod.edit',compact('contractPeriod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $contract_period_number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contract_period_number)
    {
        $this->validate($request, [
            'contract_period_name' => 'required',
        ]);
        MstContractPeriod::find($contract_period_number)->update($request->all());
        return redirect()->route('contractPeriod.index')->with('success','contractPeriod updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $contract_period_number
     * @return \Illuminate\Http\Response
     */
    public function destroy($contract_period_number)
    {
        MstContractPeriod::find($contract_period_number)->delete();
        return redirect()->route('contractPeriod.index')->with('success','contractPeriod deleted successfully');
    }
}