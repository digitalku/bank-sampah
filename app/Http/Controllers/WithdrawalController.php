<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Setoran;
use App\Withdrawal;

class WithdrawalController extends Controller
{
	public function view() {
		
        $store = Auth::user()->id;
        $storeByUser = DB::table('setoran')->where('penyetor', $store)->get();
        $hitung = DB::table('setoran')
                    ->where('penyetor', $store)
                    ->sum('setoran.pendapatan');
		return view('withdrawal')->with(['storeByUser'=> $storeByUser])->with(['hitung' => $hitung]);
	}

	// $setoran = Setoran::where('id', $id_setoran)->first();

	public function create(Request $request) {
		$id_setoran = $request->id_setoran;
		$userId = Auth::user()->id;

		$pendapatan = Setoran::where('penyetor', $userId)->sum('setoran.pendapatan');
		
		$validasi = [
	        // total pengajuan
	        'total' => 'required|numeric|max:' . $pendapatan,
	    ];

	    $createData = [
			'user_id' => $userId,
			'status' => 'pending',
			'total' => $request->total,
		];

	    // TODO: iki awas
		if (Auth::user()->role_id = '2') { // nek iki admin
			// validasi, user_id harus ada dan di isi
			$validasi['user_id'] = 'required|exists:App\Models\User,id';
			
			// ubah createData
			$createData['user_id'] = $request->user_id;
		}

		$request->validate($validasi);
		Withdrawal::create($createData);

		$pesanSukses = 'Berhasil melakukan pengajuan';

		// TODO: iki awas
		if (Auth::user()->role_id = '2') {
			$pesanSukses = 'berhasil membuatkan pengajuan';
		}

		return redirect()->back()->with('status', $pesanSukses);
	}
}