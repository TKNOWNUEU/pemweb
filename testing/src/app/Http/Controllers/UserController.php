<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'account_number' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'account_number' => $request->account_number,
            'virtual_cash' => "0",
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil. Silahkan Masuk!');
    }
    
    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Username atau Password Salah!',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password Berhasil Diubah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function top_up_action(Request $request)
    {
        $request->validate([
            'virtual_cash' => 'required',
        ]);

        if((float)$request->virtual_cash < 1000){
            return redirect()->route('topup')->with('fail', 'Pengisian Gagal, Saldo Minimal 1000');
        }
        else{

            //Mencari user dengan ID
            $user = User::find(Auth::id());
    
            //Melakukan perhitungan
            $current_virtual_cash = (float)$user->virtual_cash;
            $added_virtual_cash = (float)$request->virtual_cash;
            $total_virtual_cash = $current_virtual_cash + $added_virtual_cash;
    
            //Mengkonversi hasil perhitungan ke string dan mengirimnya ke database
            $user->virtual_cash = strval($total_virtual_cash);
            $user->save();
    
            return redirect()->route('topup')->with('success', 'V-Cash Berhasil Terisi!');
            
        }

    }

    public function transfer_action(Request $request)
    {
        $request->validate([
            'value' => 'required',
            'account_number' => 'required',
        ]);

        if($request->account_number == Auth::user()->account_number){
            return redirect()->route('transfer')->with('fail', 'Tidak bisa mengirim no rekening sendiri');
        }

        $option = $request->input('transfer_option');
        if (empty($option)) {
            return redirect()->route('transfer')->with('fail', 'Harap Pilih Metode Pembayaran!');
        } else {
            if ($option === 'account') {
                if((float)$request->value < 1000){
                    return redirect()->route('transfer')->with('fail', 'Transfer Gagal, Saldo minimal 1000');
                }
                else{
                    //Mengirim data virtual cash ke spesifik user
                    $user = User::where('account_number', $request->account_number)->first();

                    if($user == true){
                        $user->virtual_cash = strval((float)$user->virtual_cash + (float)$request->value);
                        $user->save();

                        return redirect()->route('transfer')->with('success', 'Transfer Berhasil!');
                    }
                    else{
                        return redirect()->route('transfer')->with('fail', 'Transfer Gagal, No Rekening Penerima Tidak Ditemukan');
                    }
                    
                }
            } else if($option === 'virtual_cash'){
                if((float)$request->value < 1000){
                    return redirect()->route('transfer')->with('fail', 'Transfer Gagal, Saldo minimal 1000');
                }
                else{

                    $user = User::find(Auth::id());
                    if((float)$request->value > $user->virtual_cash){
                        return redirect()->route('transfer')->with('fail', 'Transfer Gagal, Saldo Tidak Mencukupi');
                    }
                    
                    //Mengirim data virtual cash ke spesifik user
                    $user = User::where('account_number', $request->account_number)->first();

                    if($user == true){
                        $user->virtual_cash = strval((float)$user->virtual_cash + (float)$request->value);
                        $user->save();

                        //Mengurangi virtual cash
                        $user = User::find(Auth::id());
                        $user->virtual_cash = strval((float)$user->virtual_cash - (float)$request->value);
                        $user->save();
                    
                        return redirect()->route('transfer')->with('success', 'Transfer Berhasil!');
                    }
                    else{
                        return redirect()->route('transfer')->with('fail', 'Transfer Gagal, No Rekening Penerima Tidak Ditemukan');
                    }
                    
                }
            }
        }
    }

    public function guest_transfer_action(Request $request)
    {
        $request->validate([
            'value' => 'required',
            'account_number' => 'required',
        ]);

        if((float)$request->value < 1000){
            return redirect()->route('transfer')->with('fail', 'Transfer Gagal, Saldo minimal 1000');
        }
        else{
            //Mengirim data virtual cash ke spesifik user
            $user = User::where('account_number', $request->account_number)->first();

            if($user == true){
                $user->virtual_cash = strval((float)$user->virtual_cash + (float)$request->value);
                $user->save();

                return redirect()->route('transfer')->with('success', 'Transfer Berhasil!');
            }
            else{
                return redirect()->route('transfer')->with('fail', 'Transfer Gagal, No Rekening Penerima Tidak Ditemukan');
            }
                    
        }
    }
}