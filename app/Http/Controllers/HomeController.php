<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Kategori;

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
        $setoran = DB::table('setoran')->get();
        return view('home', ['setoran' => $setoran]);
    }

    public function createData()
    {
        $this->authorize('create data');
        $jenis = Kategori::all();
        return view('create', ['jenis'=>$jenis]);
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

    public function editData()
    {
        $this->authorize('edit data');

        return view('edit');
    }
}
