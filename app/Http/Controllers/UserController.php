<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblUser;
use App\Models\TblCompany;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = TblUser::orderBy('user_number','ASC')->paginate(20);
        return view('user.index',compact('users'))->with('i', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = TblCompany::pluck("name", "company_number")->all();
        return view('user.create')->with('companies', $companies);
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
        $user = TblUser::orderBy('user_number', 'desc')->first();
        TblUser::create(array_merge(['user_number' => $user->user_number == null ? 0 : ($user->user_number) + 1], $request->all()));
        return redirect()->route('user.index')->with('success','user created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $user_number
     * @return \Illuminate\Http\Response
     */
    public function show($user_number)
    {
        $user = TblUser::find($user_number);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $user_number
     * @return \Illuminate\Http\Response
     */
    public function edit($user_number)
    {
        $user = TblUser::find($user_number);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_number)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        TblUser::find($user_number)->update($request->all());
        return redirect()->route('user.index')->with('success','user updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user_number
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_number)
    {
        TblUser::find($user_number)->delete();
        return redirect()->route('user.index')->with('success','user deleted successfully');
    }

    /**
     * Show the application dataAjax.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkUser(Request $request)
    {
        $userFound = TblUser::where('id', $request->input('id'))->first();
        
        if($userFound == null) {
            return response([
                'status'  => false
            ]);
        }

        return response([
            'status'  => true
        ]);
    }
}