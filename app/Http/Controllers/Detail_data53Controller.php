<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Detail_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Detail_data53Controller extends Controller
{
    // view
    public function detailData53()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }
        return view('user.detailData', [
            'role' => $role
        ]);
    }

    // createData
    public function createData53()
    {
        if (!Auth::user()->is_aktif) {
            return redirect('/profile53');
        }
        return view('user.createData', [
            'agamas' => Agama::all()
        ]);
    }

    public function createDataProses53(Request $request)
    {
        $detail_data = Detail_data::create([
            'id_user' => Auth::user()->id,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'id_agama' => $request->id_agama,
            'foto_ktp' => $request->foto_ktp,
            'umur' => $request->umur,
        ]);

        if ($request->hasFile('foto_ktp')) {
            $request->file('foto_ktp')->move('img/', $request->file('foto_ktp')->getClientOriginalName());
            $detail_data->foto_ktp = $request->file('foto_ktp')->getClientOriginalName();
            $detail_data->save();
        }

        return redirect('/detailData53');
    }

    // update data
    public function updateData53()
    {
        return view('user.updateData', [
            'agamas' => Agama::all()
        ]);
    }

    public function updateDataProses53(Request $request)
    {
        $detail_data = Detail_data::find(Auth::user()->detail_data->id);

        $detail_data->alamat = $request->alamat;
        $detail_data->tempat_lahir = $request->tempat_lahir;
        $detail_data->tanggal_lahir = $request->tanggal_lahir;
        $detail_data->id_agama = $request->id_agama;
        $detail_data->umur = $request->umur;

        $detail_data->save();

        return redirect('/detailData53')->with('success', 'update data success');
    }
}
