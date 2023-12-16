<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }


    public function vista_registrar()
    {

        return view('admin.register');
    }

    public function home()
    {
        if (Auth::check()) {
            $usuario = Auth::user();
            $nombreUsuario = $usuario->name;
        } else {
            $nombreUsuario = null;
        }

        $fecha = now();
        return view('admin.index', compact('fecha'))->with('nombreUsuario', $nombreUsuario);
    }

    public function loguear(Request $request)
    {

        $acredenciales = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($acredenciales)) {
            $request->session()->regenerate();
            return Redirect::action([AdminController::class, 'home']);
        } else {
            return Redirect::action([AdminController::class, 'login']);
        }
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::action([AdminController::class, 'logout']);
    }

}
