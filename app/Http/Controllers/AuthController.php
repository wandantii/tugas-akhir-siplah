<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Alternatif;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\User;
use App\Models\Profil;
use Session;

class AuthController extends Controller {

  public function login() {
    return view('auth.login');
  }

  public function loginStore(Request $request) {
    $request->validate([
      'email' => 'required|email:dns',
      'password' => 'required'
    ]);
    $user = User::where('email', '=', $request->email)->first();
    if($user) {
      if(Hash::check($request->password, $user->password)) {
        $request->session()->put('loginId', $user->user_id);
        $request->session()->put('profilId', $user->profil_id);
        $request->session()->put('isAdmin', $user->admin);
        return redirect('/');
      } else {
        return back()->with('error', 'Password tidak sesuai.');
      }
    }
    // if(Auth::attempt($credentials)) {
    //   $request->session()->regenerate();
    //   return redirect()->intended('/admin');
    // }
    // return back()->with('error', 'Login gagal! Periksa kembali email dan password Anda.');
  }

  public function register() {
    return view('auth.register');
  }

  public function registerStore(Request $request) {
    $request->validate(
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
    $user = new User();
    $user->nama = $request->nama;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $response = $user->save();
    if($response) {
      return redirect('login')->with('success', 'Registrasi berhasil! Silahkan login.');
    } else {
      return back()->with('error', 'Ups! Maaf ada kesalahan, coba beberapa saat lagi.');
    }
    // $validatedData['password'] = Hash::m  ake($validatedData['password']);
    // User::create($validatedData);
    // $request->session()->flash('success', 'Registrasi berhasil! Silahkan login.');
    // return redirect('login');
    // return redirect('login')->with('success', 'Registrasi berhasil! Silahkan login.');
  }

  public function logout() {
    // Auth::logout();
    // request()->session()->invalidate();
    // request()->session()->regenerateToken();
    // return redirect('login')->with('success', 'Logout berhasil! Silahkan login.');
    if(Session::has('loginId')) {
      Session::pull('loginId');
      return redirect('login');
    }
  }

}

?>