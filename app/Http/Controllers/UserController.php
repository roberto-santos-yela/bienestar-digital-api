<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Helpers\Token;
use Illuminate\Support\Facades\Hash;

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
    public function store(Request $request)
    {
        $created_user = User::where('email', '=', $request->email)->first();

        if($created_user == null)
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = encrypt($request->password);
            $user->save();
    
            $token = new Token(["email" => $user->email]);
            $coded_token = $token->encode();
    
            return response()->json([
                    
                "token" => $coded_token,
    
            ],200);

        }else{

            return response()->json([

                "message" => "this email address is not available",

            ],401);

        }
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

    public function user_login(Request $request)
    {
        
        $user = User::where('email', '=', $request->email)->first();

        if($user != null)
        {
            $decrypted_user_password = decrypt($user->password);

        }else{

            return response()->json([

                "message" => "incorrect email or password",

            ], 401);

        }

        if($decrypted_user_password == $request->password)
        {
            $token = new Token(["email" => $user->email]);
            $coded_token = $token->encode();

            return response()->json([
                
                "token" => $coded_token,

            ], 200);

        }else{

            return response()->json([

                "message" => "incorrect email or password",

            ], 401);

        }

    }

    public function recover_password(Request $request){

        $user = User::where('email', '=', $request->email)->first();
        
        if($user != null)
        {
            $user->password = Hash::make($request->email);
            $user->save();
            var_dump($user->password); exit;


            $message = "Your new password is the following: $user->password";
            mail("mudzug@gmail.com","New user password", $message);

            return response()->json([

                "message" => "a new password was sent to your email address",
                "message" => $mail
    
            ], 200);

        }else{

            return response()->json([

                "message" => "email address is not available"
    
            ], 401);
        
        }

    }

    //POR TERMINAR//
    public function change_password(Request $request){

        $user = User::where('password', '=', $request->password)->first();

    }

    //POR TERMINAR//
    public function get_user_data(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();

        var_dump($user->name); exit;

        return response()->json([

            "name" => $user->name,
            "email" => $user->email, 
            "password" => $user->password,

        ], 400);

    }

}
