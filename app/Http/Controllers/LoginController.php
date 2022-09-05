<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            return redirect()->route('panel.index');
        }
        
        return view('login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'O email é obrigatório',
            'password.required' => 'A senha é obrigatória'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('panel.index');
        } else {
            return redirect()->back()->with('danger', 'Email ou senha inválida');
        }
    }

    public function desconnect()
    {
        Auth::logout();

        return redirect()->route('login.index');
    }

    public function register() {

        return view('register');
    }

    public function registerUser(Request $request)
    {
        $permission_to_create = false;

        $credentials = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'password.required' => 'A senha é obrigatória'
        ]);

        if(empty(User::where('email', $credentials['email'])->first())) {

            while($permission_to_create == false) {

                $possible_coding_user = Str::random(4);
                $remember_token = Str::random(10);

                if(empty(User::where('code_user', $possible_coding_user)->first())) {

                    $data_to_save = [
                        'name' => $credentials['name'],
                        'email' => $credentials['email'],
                        'password' => Hash::make($credentials['password']),
                        'code_user' => $possible_coding_user,
                        'remember_token' => $remember_token,
                    ];

                    User::create($data_to_save);

                    $permission_to_create = true;

                    return redirect()->route('login.index')->with('register_success', 'Conta criada com sucesso');
                }
            }
        }

        return redirect()->route('login.index')->with('danger', 'Já existe uma conta cadastrada com esse email');
    }
}
