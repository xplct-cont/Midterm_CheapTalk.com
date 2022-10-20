<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        $categories = Category::get()->sortBy('category');
        if(auth()->check()){
            return redirect('/');
        }
            return view('auth.login', compact('categories'));
    }

    public function registerForm()
    {
        if(auth()->check()){
            return redirect('/');
        }
            return view('auth.register');
    }

    
    public function register(Request $request)
    {
        $request->validate([
            'name'      =>  'required|string',
            'gender'      =>  'required|string',
            'email'     =>  'required|email|unique:users',
            'password'  =>  'required|string|confirmed|min:6',
        ]);

        $token = Str::random(24);

        $user = User::create([
            'name'              =>  $request->name,
            'gender'            =>  $request->gender,
            'email'             =>  $request->email,
            'password'          =>  bcrypt($request->password),
            'remember_token'    =>  $token,
        ]);

        Mail::send('auth.verification-mail', ['user'=>$user], function($mail) use ($user){
            $mail->to($user->email);
            $mail->subject('Account Verification');
            $mail->from('gingcoeddie971@gmail.com', 'Student App');
        });

        return redirect('/login')->with('message', 'Your account has been created. Please check your email for verification');
    }

    public function verification(User $user, $token){
        if($user->remember_token !== $token){
            return redirect('/login')->with('error', 'Invalid token. The attached token is invalid or has already been consumed.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect('/login')->with('message', 'Your account has been verified. You can login now.');
    }

    public function login(LoginRequest $request){
        $request->validate([
            'email'     =>  'email|required',
            'password'  =>  'string|required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || $user->email_verified_at==null){
            return redirect('/login')->with('error', 'Sorry your account is not yet verified.');
        }
        if($user->email_verified_at==null){
            return redirect('/login')->with('Error', 'This account has not completed the registration process yet.
            Could you verify your email address by clicking on the link we just emailed to you?');
        }
        
        $login = auth()->attempt([
            'email' =>  $request->email,
            'password'  =>  $request->password
        ]);

        if(!$login){
            return back()->with('error', 'Invalid Credentials');
        }

        return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/login')->with('message', 'Logged out successfully');
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
        //
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
