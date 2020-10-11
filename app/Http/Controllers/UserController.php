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
        $hitung = DB::table('setoran')
                    ->where('penyetor', $store)
                    ->sum('setoran.pendapatan');
        return view('home')->with(['roles' => $roles])->with(['role' => $role])->with(['hitung' => $hitung]);
    }

    public function ListUserAdmin()
    {
        
        $users = DB::table('users')->get();

        return datatables()->of($users)
            ->addColumn('action',function ($users){ //m

            $button ='<a href="users-edit/'.$users->id.'"><button class="btn btn-xs btn-info bg-inf" type="button"><span class="btn-label"><i class="fa fa-edit"></i> Edit</span></button></a> ';
            $button.='<a href="delete-users/'.$users->id.'" class="button delete-confirm"><button class="btn btn-xs btn-danger bg-bhy" type="button"><span class="btn-label"><i class="fa fa-trash"></i> Hapus</span></button></a> ';
            $button.='<a href="users-lihat/'.$users->id.'"><button class="btn btn-xs btn-warning bg-wrning" type="button"><span class="btn-label"><i class="fa fa-eye"></i> Lihat</span></button></a>';
            return $button;
            })
            ->rawColumns(['action'])->make(true);
        
    }

    public function ListUserPetugas()
    {
       
        $userrole = DB::table('users')
                    ->whereNotIn('role_id', array(1))
                    ->get();

        return datatables()->of($userrole)
            ->addColumn('action',function ($userrole){ //m

            $button ='<a href="users/edit/'.$userrole->id.'"><button class="btn btn-xs btn-info bg-inf" type="button"><span class="btn-label"><i class="fa fa-edit"></i> Edit</span></button></a> ';
            $button.='<button type="button" name="edit" id="'.$userrole->id.'" class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</span></button> ';
            $button.='<a href="users/lihat/'.$userrole->id.'"><button class="btn btn-xs btn-warning bg-wrning" type="button"><span class="btn-label"><i class="fa fa-eye"></i> Lihat</span></button></a>';
            return $button;
            })
            ->rawColumns(['action'])->make(true);
        
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }

    public function ListUserSetor()
    {
        $store = Auth::user()->id;
        $storeByUser = DB::table('setoran')->where('penyetor', $store)->get();

        return datatables()->of($storeByUser)->make(true);
        
    }

    public function ListSetorByUsers($id)
    {   
        $setoran = DB::table('setoran')
                    ->where('penyetor', $id)->get();
    
        return datatables()->of($setoran)->make(true);
    }

}