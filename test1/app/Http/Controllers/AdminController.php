<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class AdminController extends Controller
{

    public function dashboard(){
        return view('Admin.pages.dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return (User::all());
        return view('Admin.pages.user.index',['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo "ok";
        return view('Admin.pages.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'password' => 'required',
        ],[
            'name.required' => 'chưa nhập tên kìa',
            'name.min' => 'nhập thêm vài kí tự nữa đê',
            'email.required' => 'không nhập email à',
            'email.unique' => 'trùng mail rồi má',
            'password.required' => 'không nhập pass à',
        ]);
        if($validator->passes()){
            $user = User::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' => bcrypt($request->password)
            ]);
            $user->save();
            //return redirect('/admin/user')->with('success','Thêm thành công');
            // return response()->json(['success'=>$request->all()]);
            return view("Admin.pages.user.list",['users' => User::all()]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo "đây là show";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo "ok";
        $user = User::find($id);
        return view('Admin.pages.user.edit',['user'=>$user]);
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
        $validator = $request->validate( [
            'name' => 'required|min:3',
            'email' => 'required',
            'password' => 'required',
        ],[
            'name.required' => 'chưa nhập tên kìa',
            'name.min' => 'nhập thêm vài kí tự nữa đê',
            'email.required' => 'không nhập email à',
            'password.required' => 'không nhập pass à',
        ]);
        if($validator){
            $user = User::find($id);
            $user->update([
                'name' =>$request->name,
                'email' =>$request->email,
                // 'password' => bcrypt($request->password)
            ]);
            if($request->password != $user->password){
                $user->password = bcrypt($request->password);
            }
            $user->save();
            return redirect('/admin/user')->with('success','sua thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/user')->with('success','Xoa thành công');
    }

    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back();
    }
}
