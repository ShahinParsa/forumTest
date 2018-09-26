<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App;
use Auth;

class UserController extends Controller
{

    function __construct(){
        return $this->middleware('auth');
    }

    public function adminIndex()
    {
        //

        $allUsers = User::all();

        return view('user.admin', compact('allUsers'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //

    }


    public function show($name)
    {
        //

        return view('user.profile', ['user' => User::findOrFail($name)]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);

        @$this->validate($request,[
            'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|',
            'password' => 'required|string|min:6|confirmed',
        ]);


        $user->update($request->all());

        //redirect
        return redirect()->route('profile.show', $user->id)->withMessage('Profile is updated!');
    }


    public function destroy($id)
    {
        //
    }
}
