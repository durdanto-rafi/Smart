<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblBook;
use App\Models\MstSubject;
use App\Models\MstGrade;

class bookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = TblBook::orderBy('book_number','ASC')->paginate(20);
        return view('book.index',compact('books'))->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = MstSubject::pluck("name", "subject_number")->all();
        $grades = MstGrade::pluck("name", "grade_number")->all();
        return view('book.create')->with('subjects', $subjects)->with('grades', $grades);
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
            'image_pass' => 'required',
            'subject_number' => 'required',
            'grade_number' => 'required',
            'book_url' => 'required',
            'vertical_index' => 'required|numeric',
        ]);

        $book = TblBook::orderBy('book_number', 'desc')->first();
        TblBook::create(array_merge(['book_number' => $book->book_number == null ? 0 : ($book->book_number) + 1], $request->all()));
        return redirect()->route('book.index')->with('success','book created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $book_number
     * @return \Illuminate\Http\Response
     */
    public function show($book_number)
    {
        $book = TblBook::with('subject')->with('grade')->find($book_number);
        return view('book.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $book_number
     * @return \Illuminate\Http\Response
     */
    public function edit($book_number)
    {
        $book = TblBook::find($book_number);
        $subjects = MstSubject::pluck("name", "subject_number")->all();
        $grades = MstGrade::pluck("name", "grade_number")->all();
        return view('book.edit',compact('book'))->with('subjects', $subjects)->with('grades', $grades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $book_number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $book_number)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        TblBook::find($book_number)->update($request->all());
        return redirect()->route('book.index')->with('success','book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $book_number
     * @return \Illuminate\Http\Response
     */
    public function destroy($book_number)
    {
        TblBook::find($book_number)->delete();
        return redirect()->route('book.index')->with('success','book deleted successfully');
    }
}