<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Profil;

class AuthController extends Controller {

  public function login() {
    return view('auth.login');
  }

  public function loginStore(Request $request) {
    $credentials = $request->validate([
      'email' => 'required|email:dns',
      'password' => 'required'
    ]);
    if(Auth::attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('/admin');
    }
    return back()->with('error', 'Login gagal! Periksa kembali email dan password Anda.');
  }

  public function register() {
    return view('auth.register');
  }

  public function registerStore(Request $request) {
    $data_user = User::orderBy('created_at', 'DESC')->first();
    $validatedData = $request->validate(
      [
        'nama' => 'min:5|max:225',
        'email' => 'email:dns|unique:user',
        'password' => 'min:5|max:225'
      ],
      [   
        'nama.min' => 'Minimal terdiri dari 5 huruf.',
        'nama.max' => 'Maksimal terdiri dari 225 huruf.',
        'email.email' => 'Email tidak terdeteksi.',
        'email.unique' => 'Email telah digunakan.',
        'password.min' => 'Minimal terdiri dari 5 huruf.',
        'password.max' => 'Maksimal terdiri dari 225 huruf.'
      ]
    );
    $validatedData['password'] = Hash::make($validatedData['password']);
    User::create($validatedData);
    // $request->session()->flash('success', 'Registrasi berhasil! Silahkan login.');
    // return redirect('login');
    return redirect('login')->with('success', 'Registrasi berhasil! Silahkan login.');
  }

  public function logout() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('login')->with('success', 'Logout berhasil! Silahkan login.');
  }

}

?>