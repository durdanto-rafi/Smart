<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MstGrade;

class GradeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $grades = MstGrade::orderBy('grade_number','ASC')->paginate(20);
        return view('grade.index',compact('grades'))->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grade.create');
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
        $grade = MstGrade::orderBy('grade_number', 'desc')->first();
        MstGrade::create(array_merge(['grade_number' => $grade->grade_number == null ? 0 : ($grade->grade_number) + 1], $request->all()));
        return redirect()->route('grade.index')->with('success','grade created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $grade_number
     * @return \Illuminate\Http\Response
     */
    public function show($grade_number)
    {
        $grade = MstGrade::find($grade_number);
        return view('grade.show',compact('grade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $grade_number
     * @return \Illuminate\Http\Response
     */
    public function edit($grade_number)
    {
        $grade = MstGrade::find($grade_number);
        return view('grade.edit',compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $grade_number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $grade_number)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        MstGrade::find($grade_number)->update($request->all());
        return redirect()->route('grade.index')->with('success','grade updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $grade_number
     * @return \Illuminate\Http\Response
     */
    public function destroy($grade_number)
    {
        MstGrade::find($grade_number)->delete();
        return redirect()->route('grade.index')->with('success','grade deleted successfully');
    }
}