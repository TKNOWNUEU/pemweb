<?php

namespace App\Http\Controllers;

use App\Models\pay;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PayController extends Controller
{
    public function pay()
    {
        $data['title'] = 'pay';
        return view('home', $data);
    }

    public function pay_action(Request $request)
    {
        //melakukan validasi
        $request->validate([
            'value' => 'required',
        ]);

        $option = $request->input('payment_option');
        if (empty($option)) {
            return redirect()->route('payment')->with('fail', 'Harap Pilih Metode Pembayaran!');
        } else {
            if ($option === 'account') {
                if((float)$request->value < 1000){
                    return redirect()->route('payment')->with('fail', 'Pembayaran Gagal, Saldo minimal 1000');
                }
                else{
                    //Mengisi database
                    $pay = new Pay([
                        'account' => Auth::user()->name,
                        'account_number' => Auth::user()->account_number,
                        'value' => $request->value,
                    ]);
        
                    //Menyimpan databse
                    $pay->save();
        
                    //Kembali ke alamat route dan membrikan info
                    return redirect()->route('payment')->with('succes', 'Pembayaran berhasil');
                }
            } else if($option === 'virtual_cash'){
                //Mencari user dengan ID
                $user = User::find(Auth::id());

                if((float)$request->value > (float)$user->virtual_cash){
                    return redirect()->route('payment')->with('fail', 'Pembayaran Gagal, Saldo Tidak Mencukupi');
                }
                else{
                    //Melakukan perhitungan
                    $current_virtual_cash = (float)$user->virtual_cash;
                    $payment_value = (float)$request->value;
                    $total_virtual_cash = $current_virtual_cash-$payment_value;
    
                    //Mengkonversi hasil perhitungan ke string dan mengirimnya ke database
                    $user->virtual_cash = strval($total_virtual_cash);
                    
                    //Mengisi database
                    $pay = new Pay([
                        'account' => Auth::user()->name,
                        'account_number' => Auth::user()->account_number,
                        'value' => $request->value,
                    ]);
                    
                    $user->save();
                    $pay->save();
        
                    return redirect()->route('payment')->with('success', 'Pembayaran berhasil, Sisa V-Cash: '.$total_virtual_cash);
                }
            }
        }

        

        
    }

    public function guest_pay()
    {
        $data['title'] = 'guest_pay';
        return view('home', $data);
    }

    public function guest_pay_action(Request $request)
    {
        //melakukan validasi
        $request->validate([
            'value' => 'required',
        ]);

        if((float)$request->value < 1000){
            return redirect()->route('payment')->with('fail', 'Pembayaran gagal, saldo minimal 1000');
        }
        else{
            //Mengisi database
            $pay = new Pay([
                'account' => 'guest',
                'account_number' => $request->account_number,
                'value' => $request->value,
            ]);

            //Menyimpan databse
            $pay->save();

            //Kembali ke alamat route dan membrikan info
            return redirect()->route('payment')->with('success', 'Pembayaran berhasil');
        }

        
    }
}