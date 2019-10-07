<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;
use Hash;
use Mail;
use Auth;
use App\Mail\RegisterMail;
use App\Events\Register;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotificationEmail;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(RegisterRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        
        $user = User::create($data);
        Auth::login($user);
        $email = $user->email;
        if(!empty($user)){
	    	// $request->session()->flash('ok', 'Đã đăng ký thành công');
	    	event(new Register($user));
	    	//$user->notify(new NotificationEmail());

    	}
    	
        	//$user->notify(new NotificationEmail($name));
        	//dd($name);
        // }
        // $email = $user->email;
        //dd($email);
        //kiểm tra data đã được add vào db chưa
        // if($user->exists){
        // 	$request->session()->flash('ok', 'Đã đăng ký thành công');
        // 	event(new Register($user));
        	//Notification::send($email, new NotificationEmail($email));
        // 	$user->notify(new NotificationEmail($email));

        // }
        // else{
        // 	$request->session()->flash('ok', 'Đăng kí thất bại');
        // }
        //dd(123);
        return redirect()->route('/')->with('success','Bạn đã đăng ký thành công');  
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
    public function loginClient(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/')->with('success','Đăng nhập thành công');;
            //dd('đang nhập thành công');
        }
        else{
            return back()->with('error','Đăng nhập thất bại');
        }
    }
    public function logout(){
        if(Auth::check()){
            Auth::logout();
             return redirect('/')->with('success','Đăng xuất thành công');
            //return redirect('/')->with('thongbao','Đăng xuất thành công');
        }
    }

}
