<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Kategori;
use App\User;
use App\Setoran;
use Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        
       
        $roles = DB::table('roles')->get();
        $role = DB::table('roles')->whereNotIn('id', array(1, 2))
                    ->get();
        $store = Auth::user()->id;
       
        return view('home')->with(['roles' => $roles])->with(['role' => $role]);
    }

    public function ListUser()
    {
        $userrole = DB::table('users')
                    ->whereNotIn('role_id', array(1))
                    ->get();
        $storeByUser = DB::table('setoran')->where('penyetor', $store)->get();
        $users = DB::table('users')->get();
        //admin
        return datatables()->of($users)
            ->addColumn('action',function ($data){ //m
             $button ='<a href="#">
             <button class="btn btn-xs btn-primary " type="button">
             <span class="btn-label"><i class="fa fa-file"></i></span>
             </button>
             </a>';
             $button.='<button class="btn btn-xs btn-danger" data-record-id="'.$data->id.'" data-record-title="The first one" data-toggle="modal" data-target="#confirm-delete"><span class="btn-label"><i class="fa fa-trash"></i></span></button>';
             $button.="&nbsp";
            return $button;
            })
            ->rawColumns(['action'])->make(true);
        //petugas
        return datatables()->of($userrole)
            ->addColumn('action',function ($data){ //m
             $button ='<a href="#">
             <button class="btn btn-xs btn-primary " type="button">
             <span class="btn-label"><i class="fa fa-file"></i></span>
             </button>
             </a>';
             $button.='<button class="btn btn-xs btn-danger" data-record-id="'.$data->id.'" data-record-title="The first one" data-toggle="modal" data-target="#confirm-delete"><span class="btn-label"><i class="fa fa-trash"></i></span></button>';
             $button.="&nbsp";
            return $button;
            })
            ->rawColumns(['action'])->make(true);
        
    }

}
