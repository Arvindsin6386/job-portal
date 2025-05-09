<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\validator;
use Illuminate\Support\facades\Hash;

use function Laravel\Prompts\password;

class AccountController extends Controller
{
    // THIS METHOD WILL SHOW REGISTATION PAGES
    public function registation()
    {
        return view('front.account.registation');
    }


    // THIS METHOD WILL SHOW PROCESS
    public function processRegistation(Request $request)
    {
        // dd($request->all());
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if ($validator->passes()) {

            $user = new user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'you have register successfully');

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully.'
            ]);
        }

        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => false,
        //         'errors' => $validator->errors()
        //     ]);
        // }

        // $user = new user();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = Hash::make($request->password);
        // $user->save();

        // session()->flash('success', 'You have registered successfully.');

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Registration successful!',
        // ]);

        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }


    // THIS METHOD WILL SHOW LOGIN PAGES
    public function login()
    {
        return view('front.account.login');
    }


    public function authenticate(Request $request)
    {
        $validator = validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('account.profile');

            }else{
                return redirect()->route('account.login')->with('error', 'Either Email/Password is incorrect');
            }

        } else {
            return redirect()->route('account.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
        }
     }
        public function profile(){
            return view('front.account.profile');
        }


        public function logout(){
            Auth::logout();
            return redirect()->route('account.login');

        }

    }

