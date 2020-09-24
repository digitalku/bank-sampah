<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
        $roles = DB::table('roles')->get();
        $users = DB::table('users')->get();
        return view('home', ['roles' => $roles], ['users' => $users]);
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
            'password' => $request->password
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
            'password' => $request->password
        ]);

        return redirect('home');
     
    }

    public function sampah()
    {
        $jenis = Kategori::all();
        $setoran = DB::table('setoran')->get();
        return view('home', ['setoran' => $setoran], ['jenis' => $jenis]);
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
            'tanggal_setor' => $request->tanggal_setor
        ]);

        return redirect('home');
     
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
