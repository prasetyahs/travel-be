<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $session = session();
        if ($session->has('users')) {
            return redirect("/dashboard/home");
        }
        return view("pages.login");
    }


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => "Email Wajib diisi",
            'password.required' => "Password Wajib diisi"
        ]);

        if ($validator->fails()) {
            toast($validator->errors()->first(), 'error');
            return redirect()->back();
        }
        $req =  $request->only("email", 'password');
        $credentials =  User::select(['nama', 'email', 'id', 'password', 'role'])->where('email', $req['email'])->first();
        if ($credentials->role != 'admin') {
            toast('Akun anda bukan admin', 'error');
            return redirect()->back();
        }
        $check = Hash::check($req['password'], $credentials->password);
        if ($check) {
            session(['users' => $credentials]);
            return redirect("/dashboard/home");
        }
        toast('Login gagal, Cek username dan password anda', 'error');
        return redirect()->back();
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
