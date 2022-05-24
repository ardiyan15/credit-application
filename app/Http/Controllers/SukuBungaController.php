<?php

namespace App\Http\Controllers;

use App\Models\SukuBunga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SukuBungaController extends Controller
{
    protected $menu = 'master';

    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'suku_bunga',
            'items' => SukuBunga::orderBy('id', 'DESC')->get()
        ];

        return view('sukubunga.index')->with($data);
    }

    public function create()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'suku_bunga'
        ];

        return view('sukubunga.create')->with($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            SukuBunga::create([
                'tipe' => $request->tipe,
                'kredit_terkecil' => $request->kredit_terkecil,
                'kredit_terbesar' => $request->kredit_terbesar,
                'per_bulan' => $request->per_bulan,
                'per_tahun' => $request->per_tahun
            ]);
            DB::commit();
            return redirect('sukubunga')->with('success', 'Berhasil Menambah Suku Bunga');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal Menambah Suku Bunga');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $suku_bunga = SukuBunga::findOrFail($id);
        $data = [
            'suku_bunga' => $suku_bunga,
            'menu' => $this->menu,
            'sub_menu' => 'suku_bunga'
        ];
        return view('sukubunga.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $suku_bunga = SukuBunga::findOrFail($id);
            $suku_bunga->tipe = $request->tipe;
            $suku_bunga->kredit_terkecil = $request->kredit_terkecil;
            $suku_bunga->kredit_terbesar = $request->kredit_terbesar;
            $suku_bunga->per_bulan = $request->per_bulan;
            $suku_bunga->per_tahun = $request->per_tahun;
            $suku_bunga->save();
            DB::commit();
            return redirect('sukubunga')->with('success', 'Berhasil edit suku bunga');
        } catch (\Throwable $err) {
            DB::rollBack();
            return redirect('sukubunga')->with('error', 'Gagal edit suku bunga');
        }
    }

    public function destroy($id)
    {
        $suku_bunga = SukuBunga::findOrFail($id);

        $suku_bunga->delete();
        return back()->with('success', 'Berhasil hapus suku bunga');
    }
}
