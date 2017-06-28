<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TblUser;
use App\Models\TblCompany;
use DateTime;
use App\Libraries\StringEncrypt;
use App\Models\CntBooksUser;
use Excel;

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
        return view('user.index', compact('users'))->with('i', ($request->input('page', 1) - 1) * 20);
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
            'company_number' => 'required',
            'id' => 'required',
            'password' => 'required|min:6',
            'contract_start_day' => 'required|date',
            'contract_period_day' => 'required|date',
        ]);

        $stringEncrypt = new StringEncrypt();
        $user = TblUser::orderBy('user_number', 'desc')->first();
        $request->merge(['user_number' => $user->user_number == null ? 0 : ($user->user_number) + 1]);
        $request->merge(['id' => $stringEncrypt->encrypt($request->id)]);
        $request->merge(['password' => $stringEncrypt->encrypt($request->password)]);
        $request->merge(['flg_multi_login' => $request->has('flg_multi_login') ? true : false]);
        $request->merge(['enable' => $request->has('enable') ? true : false]);

        TblUser::create($request->all());
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
        $stringEncrypt = new StringEncrypt();
        $user = TblUser::with('company')->find($user_number);
        $user->id = $stringEncrypt->decrypt($user->id);
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
        $stringEncrypt = new StringEncrypt();
        $companies = TblCompany::pluck("name", "company_number")->all();
        $user = TblUser::find($user_number);
        $user->id = $stringEncrypt->decrypt($user->id);
        $user->password = $stringEncrypt->decrypt($user->password);
        return view('user.edit', compact('user'))->with('companies', $companies);;
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
            'company_number' => 'required',
            'id' => 'required',
            'password' => 'required',
            'contract_start_day' => 'required|date',
            'contract_period_day' => 'required|date',
        ]);

        $stringEncrypt = new StringEncrypt();
        $request->merge(['flg_multi_login' => $request->has('flg_multi_login') ? true : false]);
        $request->merge(['id' => $stringEncrypt->encrypt($request->id)]);
        $request->merge(['enable' => $request->has('enable') ? true : false]);
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
        $stringEncrypt = new StringEncrypt();
        $userFound = TblUser::where('id', $stringEncrypt->encrypt($request->input('id')) )->first();
        
        if($userFound == null) {
            return response([
                'status'  => false
            ]);
        }

        return response([
            'status'  => true
        ]);
    }

    function formatDate($date)
    {
        return Datetime::createFromFormat('d/m/Y', $date)->format('Y-m-d');
    }

    function reFormatDate($date)
    {
        return Datetime::createFromFormat('Y-m-d', $date)->format('d/m/Y');
    }

    /**
     * Show the application usersBook.
     *
     * @return \Illuminate\Http\Response
     */
    public function usersBook(Request $request)
    {
        $users = TblUser::where("enable", true)->pluck("name", "user_number")->all();
        return view('user.usersBook', compact('users'));
    }

    /**
     * Show the application getCourseStudents.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsersBooks(Request $request)
    {
        try 
        { 
            if($request->ajax())
            {
                $cntBooksUsers = DB::select("  SELECT a.book_number, a.name,  b.user_number
                                                        FROM tbl_books a
                                                        LEFT join cnt_books_user b
                                                        ON a.book_number = b.book_number
                                                        AND b.user_number = ". $request->user_number);
                return response()->json(['cntBooksUsers'=>$cntBooksUsers]);
            }
            else
            {
                return view('answerScript.index')->with('success','Please try again later !');
            }
        } 
        catch(\Illuminate\Database\QueryException $ex)
        { 
            $message = $ex->getMessage(); 
            return view('error.index', compact('message'))->with('message', $message);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_number
     * @return \Illuminate\Http\Response
     */
    public function postUsersBooks(Request $request)
    {
        $this->validate($request, [
            'user_number' => 'required',
            'result' => 'required',
        ]);
        
        CntBooksUser::where('user_number', $request->user_number)->delete();
        $cntBooksUsers = [];
        foreach($request->result as $key => $value)
        {
            $cntBooksUsers[] = array(
                'user_number' => $request->user_number,
                'book_number' => $value
            );
        };

        CntBooksUser::insert($cntBooksUsers);
        $users = TblUser::where("enable", true)->pluck("name", "user_number")->all();
        return view('user.usersBook', compact('users'))->with('success','User wise books updated successfully');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $user_number
     * @return \Illuminate\Http\Response
     */
    public function userListExcel($type)
	{   
        dd(randomPassword());
		$data = TblUser::all();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}

    /**
     * Display the password.
     *
     * @return password
     */
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return response([
            'password'  => implode($pass)
        ]);
    }
}