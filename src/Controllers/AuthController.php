<?php namespace Condoriano\AdminAuth\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller {

    public function index()
    {
        if (Auth::user())
            return redirect('/admin/');

        return view('admin_auth::login');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password]))
        {
            return \Redirect::intended('/admin');
        }

        return redirect('admin/login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/admin/');
    }

}