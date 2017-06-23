<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblCompany;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = TblCompany::orderBy('company_number','ASC')->paginate(20);
        return view('company.index',compact('companies'))->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'name' => 'required',
        ]);
        $company = TblCompany::orderBy('company_number', 'desc')->first();
        TblCompany::create(array_merge(['company_number' => $company->company_number == null ? 0 : ($company->company_number) + 1], $request->all()));
        return redirect()->route('company.index')->with('success','company created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $company_number
     * @return \Illuminate\Http\Response
     */
    public function show($company_number)
    {
        $company = TblCompany::find($company_number);
        return view('company.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $company_number
     * @return \Illuminate\Http\Response
     */
    public function edit($company_number)
    {
        $company = TblCompany::find($company_number);
        return view('company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $company_number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company_number)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        TblCompany::find($company_number)->update($request->all());
        return redirect()->route('company.index')->with('success','company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $company_number
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_number)
    {
        TblCompany::find($company_number)->delete();
        return redirect()->route('company.index')->with('success','company deleted successfully');
    }
}