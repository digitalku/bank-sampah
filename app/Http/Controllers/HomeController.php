<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Kategori;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userrole = DB::table('users')
                    ->whereNotIn('role_id', array(1))
                    ->get();
        $roles = DB::table('roles')->get();
        $role = DB::table('roles')->whereNotIn('id', array(1))
                    ->get();
        $setoran = DB::table('setoran')->get();
        $users = DB::table('users')->get();
        return view('home', ['users' => $users], ['userrole' => $userrole])->with(['roles' => $roles])->with(['setoran' => $setoran])->with(['role' => $role]);
    }

    public function lihatUser($id)
    {   $setoran = DB::table('setoran')->where('penyetor', $id)->get();
        $users = DB::table('users')->where('id', $id)->first();
        return view('lihat-user', ['users' => $users], ['setoran' => $setoran]);
    }

    public function editUser($id)
    {
    
        $users = DB::table('users')->where('id',$id)->first();
        $roles = DB::table('roles')->get();
        return view('edit-user', ['roles' => $roles], ['users' => $users]);
    }

    public function updateUsers(Request $request) 
    {
        // untuk validasi form
        $this->validate($request, [
            'name' => 'required',
            'role_id' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        // update data books
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request ->name,
            'role_id' => $request->role_id,
            'alamat' => $request->alamat,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        // alihkan halaman edit ke halaman books
        return redirect('home')->with('status', 'Data User Berhasil DiUbah');
    }

    public function storeUsers(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'alamat' => $request->alamat,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect('home')->with('status', 'Data User Berhasil Ditambahkan');
     
    }

    public function sampah()
    {
        $userrole = DB::table('users')
                    ->whereNotIn('role_id', array(1))
                    ->get();
        $users = DB::table('users')->get();
        $jenis = Kategori::all();
        $setoran = DB::table('setoran')->get();
        return view('sampah', ['setoran' => $setoran], ['jenis' => $jenis])->with(['userrole'=> $userrole])->with(['users' => $users]);
    }

    public function createData()
    {
        $this->authorize('create data');
        $category = Kategori::all();
        return view('category', ['category' => $category]);
    }

    public function store(Request $request)
    {
        DB::table('setoran')->insert([
            'user_id' => $request->user_id,
            'jenis' => $request->jenis,
            'kiloan' => $request->kiloan,
            'pendapatan' => $request->pendapatan,
            'tanggal_setor' => $request->tanggal_setor,
            'penyetor' => $request->penyetor
        ]);

        return redirect('sampah')->with('status', 'Data Sampah Berhasil Ditambahkan');
     
    }

    public function storeCategory(Request $request)
    {
        DB::table('kategori')->insert([
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'tanggal_buat' => $request->tanggal_buat
        ]);

        return redirect('category');
     
    }

    public function editData()
    {
        $this->authorize('edit data');

        return view('edit');
    }
}
