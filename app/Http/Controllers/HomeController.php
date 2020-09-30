<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Kategori;
use App\User;
use App\Setoran;
use Auth;

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
        $role = DB::table('roles')->whereNotIn('id', array(1, 2))
                    ->get();
        $store = Auth::user()->id;
        $storeByUser = DB::table('setoran')->where('penyetor', $store)->get();
        $users = DB::table('users')->get();
        
        return view('home', compact('storeByUser'))->with(['users' => $users])->with(['userrole' => $userrole])->with(['roles' => $roles])->with(['role' => $role])->with(['storeByUser' => $storeByUser]);
    }

    public function lihatUser($id)
    {   
        $setorani = DB::table('setoran')
                    ->select(DB::raw("SUM(setoran.kiloan * kategori.harga) as total"),'setoran.*', 'kategori.*')
                    ->leftJoin('kategori', 'kategori.id', 'setoran.jenis')
                    ->where('penyetor', $id)
                    ->groupBy("kategori.id")
                    ->groupBy("setoran.id")
                    ->get();
        $setoran = DB::table('setoran')
                    ->select('setoran.*', 'kategori.*')
                    ->leftJoin('kategori', 'kategori.id', 'setoran.jenis')
                    ->where('penyetor', $id)->get();
        $setorann = DB::table('setoran')->where('penyetor', $id)->first();
        $users = DB::table('users')->where('id', $id)->first();
        $jenis = Kategori::all();
        return view('lihat-user', ['users' => $users], ['setoran' => $setoran])->with(['jenis' => $jenis])->with(['setorann' => $setorann])->with(['setorani' => $setorani]);
    }


    public function updatePendapatan(Request $request) 
    {
        $this->validate($request, [
            'user_id' => 'required',
            'jenis' => 'required',
            'kiloan' => 'required',
            'pendapatan' => 'nullable',
            'tanggal_setor' => 'required',
            'penyetor' => 'required'
        ]);
        
        DB::table('setoran')->where('id', $request->id)->update([
            'user_id' => $request ->user_id,
            'jenis' => $request->jenis,
            'kiloan' => $request->kiloan,
            'pendapatan' => $request->pendapatan,
            'tanggal_setor' => $request->tanggal_setor,
            'penyetor' => $request->penyetor
        ]);
        return redirect()->back()->with('status', 'Data Sampah Berhasil Ditotal');
    }

    public function storeWithUser(Request $request)
    {
        DB::table('setoran')->insert([
            'user_id' => $request->user_id,
            'jenis' => $request->jenis,
            'kiloan' => $request->kiloan,
            'pendapatan' => $request->pendapatan,
            'tanggal_setor' => $request->tanggal_setor,
            'penyetor' => $request->penyetor
        ]);

        return redirect()->back()->with('status', 'Data Sampah Berhasil Ditambah');
     
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

    public function editUser($id)
    {
    
        $users = DB::table('users')->where('id',$id)->first();
        $roles = DB::table('roles')->get();
        return view('edit-user', ['roles' => $roles], ['users' => $users]);
    }

    public function deleteUser($id)
    {

        User::find($id)->delete();
     
        return redirect('home')->with('status', 'Data User Berhasil Dihapus');
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

    public function editSetor($id)
    {
        $userrole = DB::table('users')
                    ->whereNotIn('role_id', array(1))
                    ->get();
        $users = DB::table('users')->get();
        $setor = DB::table('setoran')->where('id',$id)->first();
        $jenis = DB::table('kategori')->get();
        return view('edit-sampah', ['jenis' => $jenis], ['setor' => $setor])->with(['userrole'=> $userrole])->with(['users' => $users]);
    }

    public function updateSetor(Request $request) 
    {
        // untuk validasi form
        $this->validate($request, [
            'user_id' => 'required',
            'jenis' => 'required',
            'kiloan' => 'required',
            'pendapatan' => 'nullable',
            'tanggal_setor' => 'required',
            'penyetor' => 'required'
        ]);
        // update data books
        DB::table('setoran')->where('id', $request->id)->update([
            'user_id' => $request ->user_id,
            'jenis' => $request->jenis,
            'kiloan' => $request->kiloan,
            'pendapatan' => $request->pendapatan,
            'tanggal_setor' => $request->tanggal_setor,
            'penyetor' => $request->penyetor
        ]);
        // alihkan halaman edit ke halaman books
        return redirect('sampah')->with('status', 'Data Sampah Berhasil DiUbah');
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

   
    public function deleteSetor($id)
    {

        Setoran::find($id)->delete();
        return redirect()->back()->with('status', 'Data Sampah Berhasil Dihapus');
    }

    public function deleteSetorUser($id)
    {

        Setoran::find($id)->delete();
        return redirect()->back()->with('status', 'Data Sampah Berhasil Dihapus');
    }

    //kategori
    public function createData()
    {
        $this->authorize('create data');
        $category = Kategori::all();
        return view('category', ['category' => $category]);
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

    public function editCategory($id)
    {
        $this->authorize('edit data');

        $category = DB::table('kategori')->where('id',$id)->first();
        return view('edit-category', ['category' => $category]);
    }

    public function updateCategory(Request $request) 
    {
        // untuk validasi form
        $this->validate($request, [
            'jenis' => 'required',
            'harga' => 'required',
            'tanggal_buat' => 'required'
        ]);
        // update data books
        DB::table('kategori')->where('id', $request->id)->update([
            'jenis' => $request ->jenis,
            'harga' => $request->harga,
            'tanggal_buat' => $request->tanggal_buat
        ]);
        // alihkan halaman edit ke halaman books
        return redirect('category')->with('status', 'Data Kategori Berhasil Diubah');
    }

    public function deleteCategory($id)
    {

        Kategori::find($id)->delete();
        return redirect()->back()->with('status', 'Data Kategori Berhasil Dihapus');
    }
}
