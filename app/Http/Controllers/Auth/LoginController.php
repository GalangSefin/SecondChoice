<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function ajaxLogin(Request $request)
    {
        try {
            $credentials = $request->only($this->username(), 'password');
            
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json([
                    'success' => true,
                    'redirect' => $this->redirectTo
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Email/Username atau password salah'
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    public function username()
    {
        $login = request()->input('email');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return response()->json([
            'success' => true,
            'redirect' => '/'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $user = User::where($this->username(), $credentials[$this->username()])->first();

        if ($user) {
            if (!$user->hasVerifiedEmail()) {
                Auth::login($user);
                return response()->json([
                    'success' => false,
                    'message' => 'Email belum diverifikasi.',
                    'redirect' => route('verification.notice')
                ], 403);
            }

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return response()->json([
                    'success' => true,
                    'redirect' => route('home')
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Email atau password salah'
        ], 401);
    }
}
