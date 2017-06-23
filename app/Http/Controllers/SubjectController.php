<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MstSubject;

class SubjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subjects = MstSubject::orderBy('subject_number','ASC')->paginate(20);
        return view('subject.index',compact('subjects'))->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subject.create');
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
        $subject = MstSubject::orderBy('subject_number', 'desc')->first();
        MstSubject::create(array_merge(['subject_number' => $subject->subject_number == null ? 0 : ($subject->subject_number) + 1], $request->all()));
        return redirect()->route('subject.index')->with('success','subject created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $subject_number
     * @return \Illuminate\Http\Response
     */
    public function show($subject_number)
    {
        $subject = MstSubject::find($subject_number);
        return view('subject.show',compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $subject_number
     * @return \Illuminate\Http\Response
     */
    public function edit($subject_number)
    {
        $subject = MstSubject::find($subject_number);
        return view('subject.edit',compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $subject_number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $subject_number)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        MstSubject::find($subject_number)->update($request->all());
        return redirect()->route('subject.index')->with('success','subject updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $subject_number
     * @return \Illuminate\Http\Response
     */
    public function destroy($subject_number)
    {
        MstSubject::find($subject_number)->delete();
        return redirect()->route('subject.index')->with('success','subject deleted successfully');
    }
}