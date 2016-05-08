<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // for form request purpose

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator; // for validation purpose
use DB; // for using database purpose
use Hash; //for decript password
use Auth; //for auhenticate purpose


class AdminController extends Controller
{
    public function signUp()
    {
      return view('signupForm');

    }

    public function signMe(Request $request)
    {
        //print_r($_POST); // This is echo the form for post method
       //print_r($request->all()); //Use $request method
        // echo $request->first_name; // get here single record using request method

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $password = $request->password;
        $remember_token = $request->token;
        $date = date('Y-m-d H:i:s');
        $validator = Validator::make(
            array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'c_password' => $request->c_password,
            ),array(
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required |email ',
                'password' => 'required',
                'c_password' => 'required | same:password'
            )
        );
        if($validator->fails()){
            return redirect('signUp')->withErrors($validator)->withInput();
        }else{
           // echo"This is fine";
            $data = array(
                "name" =>$first_name."".$last_name,
                "email"=>$email,
                "password"=>Hash::make($password),
                "remember_token"=>$remember_token,
                "created_at"=>$date,
                "updated_at"=>$date

            );

            $id_email = DB::table('users')->SELECT('email')->WHERE('email',$email)->get(); // check Dublicate entry
           // dd($id_email);
            if(count($id_email)== 0)
            {

                if(DB::table('users')->insert($data)){
                    return redirect('signUp')->with("success","Successfully Sign Up");
                }else{
                    return redirect('signUp')->with("error","Not Inserted");
                }
           }else{
                return redirect('signUp')->with("error","Email is already there");
            }
        }



    }


    public function login_form()
    {
        return view('login');
    }

    public function checklogin(Request $request)
    {
        //echo 'Login Successful.';
      //  print_r($request->all());
        $user = ["email"=> $request->email, "password"=> $request->password];
       // dd($user);
        if(Auth::attempt($user)){
            return redirect()->intended('userProfile');
        } else {
            return redirect('login')->with('error','Provide Proper Email and Password');

        }
    }

    public function getprofile()
    {
        return view('UserProfile');
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->intended('login');
    }


}
