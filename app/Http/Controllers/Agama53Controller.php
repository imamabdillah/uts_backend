<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Agama53Controller extends Controller
{
    public function agama53()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }

        return view('agama.agama', [
            'agamas' => Agama::all(),
            'no' => 1,
            'role' => $role,
        ]);
    }

    public function createAgama53()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }
        return view('agama.tambahAgama', [
            'role' => $role
        ]);
    }

    public function createAgama53Proses(Request $request)
    {
        Agama::create([
            'nama_agama' => $request->nama_agama,
        ]);

        return redirect('/agama53')->with('success', 'tambah agama berhasil');
    }

    public function deleteAgama53Proses($id)
    {
        Agama::find($id)->delete();

        return redirect('/agama53')->with('success', 'hapus agama berhasil');
    }

    public function updateAgama53($id)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;
        } else {
            $role = null;
        }
        return view('agama.updateAgama', [
            'agama' => Agama::find($id),
            'role' => $role
        ]);
    }

    public function updateAgama53Proses(Request $request, $id)
    {
        $agama = Agama::find($id);
        $agama->nama_agama = $request->nama_agama;
        $agama->save();
        return redirect('/agama53')->with('success', 'update agama success');
    }
}
