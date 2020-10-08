<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\Verifikasi;

class PhpmailerController extends Controller
{
    public function Mail(){
        return view('mail');
    }
    public function sendMail(Request $request){
        try{
        	Mail::to($request->penerima)->send(new Verifikasi([
				'pesan' => $request->pesan
        	]));
            // Mail::send('isi-email', array('pesan' => $request->pesan) , function($pesan) use($request){
            //     $pesan->to($request->penerima,'Verifikasi')->subject('Verifikasi Email');
            //     $pesan->view()
            //     // $pesan->from(env('danarahmatullah123@gmail.com','danarahmatullah123@gmail.com'),'Verifikasi Akun email anda');
            // });
        }catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }
}
