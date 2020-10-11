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
use Illuminate\Support\Facades\Mail;
use App\Mail\Withdrawal;
use App\Mail\Approved;
use App\WithdrawalTable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
        $hitung = DB::table('setoran')
                    ->where('penyetor', $store)
                    ->sum('setoran.pendapatan');
        $users = DB::table('users')->get();
        
        return view('home', compact('storeByUser'))->with(['users' => $users])->with(['userrole' => $userrole])->with(['roles' => $roles])->with(['role' => $role])->with(['storeByUser' => $storeByUser])->with(['hitung' => $hitung]);
    }

    public function lihatUser($id)
    {   
        $setorani = DB::table('setoran')
                    ->select('setoran.*', 'kategori.*')
                    ->leftJoin('kategori', 'kategori.id', 'setoran.jenis')
                    ->where('setoran.penyetor', $id)
                    ->get();
        $setoran = DB::table('setoran')
                    ->where('penyetor', $id)->get();
        $hitung = DB::table('setoran')
                    ->where('penyetor', $id)
                    ->sum('setoran.pendapatan');
        $setorann = DB::table('setoran')->where('penyetor', $id)->first();
        $users = DB::table('users')->where('id', $id)->first();
        $usersi = DB::table('users')->get();
        $jenis = Kategori::all();
        return view('lihat-user', ['users' => $users], ['setoran' => $setoran])->with(['jenis' => $jenis])->with(['setorann' => $setorann])->with(['usersi' => $usersi])->with(['setorani' => $setorani])->with(['hitung' => $hitung]);
    }


    public function Withdrawall()
    {   

        $store = Auth::user()->id;  
        $users = DB::table('users')->where('id', $store)->first();
        return view('withdrawal')->with(['users' => $users]);
    }

    public function Withdrawal(Request $request)
    {   
        $role = DB::table('users')->where('role_id', '2')
                ->select('email')
                ->get();
        try{
            Mail::to($role)->send(new Withdrawal([
                'pendapatan' => $request->pendapatan,
                'name' => $request->name
            ]));
        }catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }

        $pendapatan = $request->pendapatan;
        if (is_numeric($pendapatan)) {
            $pendapatan = -$pendapatan;
        }

        DB::table('setoran')->insert([
            'user_id' => $request->user_id,
            'jenis' => 'withdrawal',
            'kiloan' => 0,
            'pendapatan' => $pendapatan,
            'tanggal_setor' => Carbon::now()->toDateTimeString(),
            'penyetor' => $request->penyetor,
        ]);

        $penarikan = $request->pendapatan;

        DB::table('withdrawal')->insert([
            'user_id' => $request->user_id,
            'jumlah_penarikan' => $penarikan,
        ]);

        return redirect()->back()->with('status', 'Pengajuan Withdrawal Berhasil');
    }

    public function Approve(Request $request)
    {
        try{
            Mail::to($request->penerima)->send(new Approved([
                'pesan' => $request->pesan
            ]));
        }catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }

        $sampah = DB::table('setoran')
            ->where('id', $request->id)
            ->select('jenis', 'kiloan', 'penyetor')
            ->first();

        DB::table('setoran')
            ->where('id', $request->id)
            ->update(['approved' => 1]);

        return redirect()->route("users-lihat", ["id" => $sampah->penyetor])->with('status', 'Withdrawal Berhasil di Approved');
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
            'tanggal_setor' => Carbon::now()->toDateTimeString(),
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
            'tanggal_setor' => Carbon::now()->toDateTimeString(),
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
            'password' => 'required',
            'rekening' => 'nullable'
        ]);
        // update data books
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request ->name,
            'role_id' => $request->role_id,
            'alamat' => $request->alamat,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rekening' => $request->rekening
        ]);
        // alihkan halaman edit ke halaman books
        return redirect()->back()->with('status', 'Data User Berhasil diubah');
    }

    public function storeUsers(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->name,
            'role_id' => $request->role_id,
            'alamat' => $request->alamat,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rekening' => $request->rekening
        ]);

        return redirect()->back()->with('status', 'Data User Berhasil Ditambahkan');
     
    }

    public function editUser($id)
    {
        $role = DB::table('roles')->whereNotIn('id', array(1, 2))
                    ->get();
        $users = DB::table('users')->where('id',$id)->first();
        $roles = DB::table('roles')->get();
        return view('edit-user', ['roles' => $roles], ['users' => $users])->with(['role' => $role]);
    }

    public function deleteUser($id)
    {

        User::find($id)->delete();
     
        return redirect()->back()->with('status', 'Data User Berhasil Dihapus');
    }

    public function sampah()
    {
        $userrole = DB::table('users')
                    ->whereNotIn('role_id', array(1))
                    ->get();
        $users = DB::table('users')->get();
        $jenis = Kategori::all();
        $setoran = DB::table('setoran')
                    ->select('setoran.*', 'users.*')
                    ->leftJoin('users', 'users.id', 'setoran.penyetor')
                    ->where('jenis', '!=', 'withdrawal')
                    ->get();
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
        
        return redirect('sampah')->with('status', 'Data Sampah Berhasil DiUbah');
    }

    /**
     * 
     */
    public function setSetoran(Request $request)
    {
        $sampah = DB::table('setoran')
            ->where('id', $request->id)
            ->select('jenis', 'kiloan', 'penyetor')
            ->first();

        $kategori = DB::table('kategori')
            ->where('jenis', $sampah->jenis)
            ->select('harga')
            ->first();

        $pendapatan = $kategori->harga * $sampah->kiloan;

        DB::table('setoran')
            ->where('id', $request->id)
            ->update(['pendapatan' => $pendapatan]);

        return redirect()->route("users-lihat", ["id" => $sampah->penyetor])->with('status', 'Data Sampah Berhasil ditotal');
    }


    public function updateSetorr(Request $request) 
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
        
        DB::table('setoran')->where('id', $request->id)->update([
            'user_id' => $request ->user_id,
            'jenis' => $request->jenis,
            'kiloan' => $request->kiloan,
            'pendapatan' => $request->pendapatan,
            'tanggal_setor' => $request->tanggal_setor,
            'penyetor' => $request->penyetor
        ]);
        
        return redirect()->back()->with('status', 'Data Sampah Berhasil Diubah');
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

        return redirect()->back()->with('status', 'Data Sampah Berhasil Ditambah');
     
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
        $category = Kategori::where('jenis', '!=', 'withdrawal')->get();
        return view('category', ['category' => $category]);
    }

    public function storeCategory(Request $request)
    {
        if ($request->jenis == 'withdrawal') {
            return redirect()->back()->with('status', 'Gak oleh nambah jenis withdrawal');
        }
        
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

    public function tentangKami()
    {

        return view('tentang-kami');
    }

    public function UbahPassword()
    {
        
        $store = Auth::user()->id;        
        $users = DB::table('users')->where('id', $store)->first();
        $role = DB::table('roles')->whereNotIn('id', array(1, 2))
                    ->get();
        $roles = DB::table('roles')->get();
        return view('ubah-password')->with(['users' => $users])->with(['role' => $role])->with(['roles' => $roles]);
    }
}
