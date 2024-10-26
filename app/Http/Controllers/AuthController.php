<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function loginSystem()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        try {
                $credentials = $request->only('email','password');
                if (Auth::attempt($credentials)) {
                    session()->put('user_id', Auth::user()->id);
                    return redirect()->route('system.dashboard');
                }
                return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
            }
        catch (\Throwable $th){
            $message="Invalid Credentials or Account.";
            return redirect()->back()->withErrors($message);
        }
    }
    public function dashboard()
    {   
        $is_active = "";
        return view('dashboard.index',compact('is_active'));
    }
    
    public function logout(){
        session()->flush();
        \Cookie::forget('laravel_session');
        Auth::logout();
        return redirect()->route('landing');

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
